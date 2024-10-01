<?php

namespace App\DataTables\Backend;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PostDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('author', function (Post $post) {
                return $post->user ? $post->user->name : 'No Author'; // Customize the format here
            })
            ->addColumn('image', function (Post $post) {
                $imageUrl = checkMinioImage($post->image);

                return view('backend.post.component.table.image', [
                    'imageUrl'  => $imageUrl,
                ]);
            })
            ->editColumn('author', function (Post $post) {
                // Start building the HTML for the author information
                $html = '<ul style="list-style-type: none; padding: 0;">';

                // Add the author's image
                $html .= '<li style="margin-bottom: 5px;">';
                $html .= '<img src="' . checkMinioImage($post->user->image) . '" alt="User Image" width="35" height="35">';
                $html .= '</li>';

                // Add the author's full name
                $html .= '<li style="margin-bottom: 5px;">';
                $html .= '<strong>Full Name:</strong> <b>' . htmlspecialchars($post->user->name) . '</b>';
                $html .= '</li>';

                // Add the author's email
                $html .= '<li style="margin-bottom: 5px;">';
                $html .= '<strong>Email:</strong> <b>' . htmlspecialchars($post->user->email) . '</b>';
                $html .= '</li>';

                // Add the author's phone number
                $html .= '<li style="margin-bottom: 5px;">';
                $html .= '<strong>Phone:</strong> <b>' . htmlspecialchars($post->user->phone) . '</b>';
                $html .= '</li>';

                // Close the unordered list
                $html .= '</ul>';

                return $html; // Return the HTML string
            })

            ->editColumn('category', function (Post $post) {
                // Get an array of category names
                $categoryNames = $post->categories->pluck('name')->toArray();

                // Build the HTML for displaying categories
                $html = '<ul>';
                foreach ($categoryNames as $category) {
                    $html .= '<li style="margin-bottom: 5px;">';
                    $html .= '<span class="badge text-bg-success">' . htmlspecialchars($category) . '</span>'; // Use htmlspecialchars to prevent XSS
                    $html .= '</li>';
                }
                $html .= '</ul>';

                return $html; // Return the HTML string
            })
            ->editColumn('tag', function (Post $post) {
                // Get an array of tag names
                $tagNames = $post->tags->pluck('name')->toArray();

                // Build the HTML for displaying tags
                $html = '<ul>';
                foreach ($tagNames as $tag) {
                    $html .= '<li style="margin-bottom: 5px;">';
                    $html .= '<span class="badge text-bg-info">' . htmlspecialchars($tag) . '</span>'; // Use a different color for tags
                    $html .= '</li>';
                }
                $html .= '</ul>';

                return $html; // Return the HTML string
            })
            ->editColumn('created_at', function (Post $post) {
                return $post->created_at->format('Y-m-d H:i:s'); // Customize the format here
            })
            ->addColumn('action', 'backend.post.component.table.action')
            ->rawColumns(['author', 'category', 'tag', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Post $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('post-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('image'),
            Column::make('author'),
            Column::make('title'),
            Column::make('status'),
            Column::make('views_count'),
            Column::make('category'),
            Column::make('tag'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Post_' . date('YmdHis');
    }
}
