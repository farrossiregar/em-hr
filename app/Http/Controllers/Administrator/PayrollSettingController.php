<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PayrollPtkp;
use App\Models\PayrollPPH;
use App\Models\PayrollOthers;
use App\Models\PayrollEarnings;
use App\Models\PayrollDeductions;

class PayrollSettingController extends Controller
{   

	public function __construct(\Maatwebsite\Excel\Excel $excel)
	{
	    $this->excel = $excel;
	}

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $params['ptkp']     = PayrollPtkp::all();
        $params['pph']      = PayrollPPH::all();
        $params['others']   = PayrollOthers::all();
        $params['earnings'] = PayrollEarnings::all();
        $params['deductions']= PayrollDeductions::all();

        return view('administrator.payroll-setting.index')->with($params);
    }

    /**
     * [deletePtkp description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deletePtkp($id)
    {       
        $pph = PayrollPtkp::where('id', $id)->first();
        $pph->delete();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', 'PTKP Setting berhasil di hapus');
    }

    /**
     * [editOthers description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function editOthers($id)
    {
        $params['data'] = PayrollOthers::where('id', $id)->first();

        return view('administrator.payroll-setting.edit-others')->with($params);
    }

    /**
     * [deleteOthers description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteOthers($id)
    {       
        $pph = PayrollOthers::where('id', $id)->first();
        $pph->delete();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', 'Others Setting berhasil di hapus');
    }

    /**
     * [updateOthers description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateOthers(Request $request, $id)
    {
        $data           = PayrollOthers::where('id', $id)->first();
        $data->label    = $request->label;
        $data->value    = $request->value;
        $data->save();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', 'Data berhasil disimpan');
    }

    /**
     * [addPPH description]
     */
    public function addPPH()
    {
        return view('administrator.payroll-setting.add-pph');
    }

    /**
     * [addPPH description]
     */
    public function editPPH($id)
    {
        $params['data'] = PayrollPPH::where('id', $id)->first();

        return view('administrator.payroll-setting.edit-pph')->with($params);
    }

    /**
     * [deletePPH description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deletePPH($id)
    {       
        $pph = PayrollPPH::where('id', $id)->first();
        $pph->delete();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', 'PPH Setting berhasil di hapus');
    }


    /**
     * [addOthers description]
     */
    public function addOthers()
    {
        return view('administrator.payroll-setting.add-others');
    }   

    /**
     * [updatePPH description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function updatePPH(Request $request, $id)
    {
        $data                   = PayrollPPH::where('id', $id)->first();
        $data->batas_bawah      = $request->batas_bawah;
        $data->batas_atas       = $request->batas_atas;
        $data->tarif            = $request->tarif;
        $data->pajak_minimal    = $request->pajak_minimal;
        $data->akumulasi_pajak  = $request->akumulasi_pajak;
        $data->kondisi_lain     = $request->kondisi_lain;
        $data->save();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', 'Data berhasil disimpan');
    }

    /**
     * [storePPH description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function storePPH(Request $request)
    {
        $data                   = new PayrollPPH();
        $data->batas_bawah      = $request->batas_bawah;
        $data->batas_atas       = $request->batas_atas;
        $data->tarif            = $request->tarif;
        $data->pajak_minimal    = $request->pajak_minimal;
        $data->akumulasi_pajak  = $request->akumulasi_pajak;
        $data->kondisi_lain     = $request->kondisi_lain;
        $data->save();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', 'Data berhasil disimpan');
    }

    /**
     * [storeOthers description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function storeOthers(Request $request)
    {
        $data           = new PayrollOthers();
        $data->label    = $request->label;
        $data->value    = $request->value;
        $data->save();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', 'Data berhasil disimpan');
    }

    /**
     * [editPtkp description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function editPtkp($id)
    {
        $params['data'] = PayrollPtkp::where('id', $id)->first();

        return view('administrator.payroll-setting.edit-ptkp')->with($params);
    }

    /**
     * [storePPH description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updatePtkp(Request $request)
    {
        $data                       = new PayrollPtkp();
        $data->bujangan_wanita      = $request->bujangan_wanita;
        $data->menikah              = $request->menikah;
        $data->menikah_anak_1       = $request->menikah_anak_1;
        $data->menikah_anak_2       = $request->menikah_anak_2;
        $data->menikah_anak_3       = $request->menikah_anak_3;
        $data->save();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', 'Data berhasil disimpan');
    }

    /**
     * Store Earnings
     * @return redirect
     */
    public function storeEarnings(Request $request)
    {
        $data           = new PayrollEarnings();
        $data->title    = $request->title;
        $data->save();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', __('general.message-data-saved-success'));
    }

    /**
     * Store Deductions
     * @return redirect
     */
    public function storeDeductions(Request $request)
    {
        $data           = new PayrollDeductions();
        $data->title    = $request->title;
        $data->save();

        return redirect()->route('administrator.payroll-setting.index')->with('message-success', __('general.message-data-saved-success'));
    }
}
