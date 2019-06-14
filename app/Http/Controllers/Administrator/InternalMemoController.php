<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InternalMemo;

class InternalMemoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        if($user->project_id != NULL)
        {
            $params['data'] = InternalMemo::orderBy('id', 'DESC')->join('users','users.id','=','internal_memo.user_created')->where('users.project_id', $user->project_id)->get();
        } else
        {
            $params['data'] = InternalMemo::orderBy('id', 'DESC')->get();
        }
        return view('administrator.internal-memo.index')->with($params);
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {   
        return view('administrator.internal-memo.create');
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $params['data'] = InternalMemo::where('id', $id)->first();

        return view('administrator.internal-memo.edit')->with($params);
    }

    /**
     * [update description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function update(Request $request, $id)
    {
        $data                   = InternalMemo::where('id', $id)->first();
        $data->title            = $request->title;
        
        if (request()->hasFile('file'))
        {
            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

            $destinationPath = public_path('/storage/internal-memo/');
            $file->move($destinationPath, $fileName);

            $data->file = $fileName;
        }

        $data->save();

        return redirect()->route('administrator.internal-memo.index')->with('message-success', 'Data berhasil disimpan');
    }   

    /**
     * [desctroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $data = InternalMemo::where('id', $id)->first();
        $data->delete();

        return redirect()->route('administrator.internal-memo.index')->with('message-sucess', 'Data berhasi di hapus');
    } 

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $data                   = new InternalMemo();
        $data->title            = $request->title;

        if (request()->hasFile('file'))
        {
            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

            $destinationPath = public_path('/storage/internal-memo/');
            $file->move($destinationPath, $fileName);

            $data->file = $fileName;
        }

        $data->save();

        return redirect()->route('administrator.internal-memo.index')->with('message-success', 'Data berhasil disimpan !');
    }
}
