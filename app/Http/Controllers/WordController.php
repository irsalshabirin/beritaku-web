<?php

namespace beritaku\Http\Controllers;

use Illuminate\Http\Request;
use beritaku\Http\Requests;
use beritaku\Word;
use Yajra\Datatables\Datatables;

class WordController extends Controller {

    private $words;

    public function __construct() {
        $this->words = new Word();
    }

    public function index() {

//        return view('backend.word')->with([
//                    'words' => $this->words->getAll(),
//                    'ajax' =>  $this->getAllData()
//        ]);

        return view('backend.word');
    }

    public function store(Request $request) {

        $word = trim($request->input('word'));
        $type = trim($request->input('type'));

        try {

            $this->words->add($word, $type);
        } catch (\Exception $e) {

            return redirect('admin/word')->with(
                            'failed', 'Word tidak berhasil ditambahkan.'
            );
        }

        return redirect('admin/word')->with(
                        'success', 'Word berhasil ditambahkan.'
        );
    }

    public function edit($id) {
        $word = $this->words->find($id);
    }

    public function update(Request $request) {

        $id = $request->input('id');
        $word = $request->input('word');
        $type = $request->input('type');

        try {
            $this->words->edit($id, $word, $type);
        } catch (\Exception $e) {
            return redirect('admin/word')->with(
                            'failed', 'Word tidak berhasil ditambahkan.'
            );
        }

        return redirect('admin/word')->with(
                        'success', 'Word berhasil diubah.'
        );
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData() {
        $words = $this->words->select(['id', 'word', 'type'])->get();
        
        return Datatables::of($words)
            ->addColumn('action', function ($word) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Action
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" data-toggle="modal" data-id="' . $word->id . '" data-word="' . $word->word . '" data-type="' . $word->type . '" data-target="#edit-modal" class="edit-modal" >Edit</a></li>
                                <li><a href="#" data-toggle="modal" data-id="' . $word->id . '" data-word="' . $word->word . '" data-target="#delete-modal" class="delete-modal">Delete</a></li>
                            </ul>
                        </div> ';
            })
            //->editColumn('id', '{{$id}}')
            //->removeColumn('password')
            ->make(true);
    }

    public function destroy(Request $request) {
        $id = $request->input('id');

        $this->words->remove($id);
        return redirect('admin/word')->with('success', 'Word berhasil dihapus.');
    }

}
