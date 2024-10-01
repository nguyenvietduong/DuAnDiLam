<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Word\StoreWordRequest;
use App\Http\Requests\Backend\Word\UpdateWordRequest;
use App\Models\word;
use App\Repositories\Interfaces\WordRepositoryInterface as WordRepository;
use App\Services\Interfaces\WordServiceInterface        as WordService;
use Illuminate\Http\Request;

class WordController extends Controller
{
    protected $wordService;
    protected $wordRepository;

    public function __construct(
        WordService     $wordService,
        WordRepository  $wordRepository
    ) {
        $this->wordService      = $wordService;
        $this->wordRepository   = $wordRepository;
    }

    public function index(Request $request)
    {
        $config['model']    = 'word';
        $config['seo']      = config('apps.messages.word');
        $words              = $this->wordService->paginate($request);

        return view('backend.word.index', compact('config', 'words'));
    }

    public function create()
    {
        $config['model']    = 'word';
        $config['seo']      = config('apps.messages.word');

        return view('backend.word.create', compact('config'));
    }


    public function store(StoreWordRequest $request)
    {
        if ($this->wordService->create($request)) {
            return redirect()->route('admin.word.index')->with('success', 'Record added successfully');
        }
        return redirect()->route('admin.word.index')->with('error', 'Failed to add record. Please try again');
    }


    public function edit($id)
    {
        $config['model']    = 'word';
        $config['seo']      = config('apps.messages.word');
        $word               = $this->wordRepository->findById($id);

        return view('backend.word.edit', compact('config', 'word'));
    }

    public function update(UpdateWordRequest $request, $id)
    {
        if ($this->wordService->update($id, $request)) {
            return redirect()->route('admin.word.index')->with('success', 'Record updated successfully');
        }

        return redirect()->route('admin.word.index')->with('error', 'Failed to update record. Please try again');
    }

    public function destroy($id)
    {
        if ($this->wordService->destroy($id)) {
            return redirect()->route('admin.word.index')->with('success', 'Record deleted successfully');
        }
        return redirect()->route('admin.word.index')->with('error', 'Failed to delete record. Please try again');
    }
}
