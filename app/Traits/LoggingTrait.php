<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;

use App\Enums\Logging\LogTypeEnum;

trait LoggingTrait
{
    use IpTrait;

    /**
     * Collect base information from request like uri, method, ip, etc.
     *
     * Function has 3 kind of output
     * - Array with request's information of client who call API
     * - Array with command name if this is command call inside system
     * - Array with only type is 'UNKNOWN'
     *
     * @param null $request
     * @return array
     */
    public function collectBaseInformation($request = null): array
    {
        try {
            // Check request come from user call API
            if ($request instanceof Request) {
                $header = $request->header();
                $result = [
                    'type' => LogTypeEnum::USER_REQUEST,
                    'uri' => $request->getUri() ?? null,
                    'method' => $request->getMethod() ?? null,
                    'referer' => $request->headers->get('referer') ?? null,
                    'user-agent' => $header['user-agent'] ?? null,
                    'sid' => ($request->bearerToken()) ? md5($request->bearerToken()) : null,
                    'ip' => $this->getClientIp(),
                    'parameters' => $request->except(
                        'password',
                        'new_password',
                        'confirm_password',
                        'current_password'
                    ),
                ];
                $user = $request->user();
                if (isset($user)) {
                    $result['user'] = [
                        'id' => $user->id,
                        'support_id' => $user->support_id,
                        'role' => $user->role,
                    ];
                }
                return $result;
            }
            // Check request come from system command like "php artisan ..."
            if ($_SERVER['SCRIPT_NAME'] === 'artisan') {
                return [
                    'type' => LogTypeEnum::SYSTEM_COMMAND,
                    'command' => $_SERVER['argv'] ?? null,
                ];
            }
        } catch (Exception $error) {
            // Do nothing, just prevent case some error occur
        }
        return ['type' => LogTypeEnum::UNKNOWN];
    }
}
