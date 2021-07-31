<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{

    // <!-- ////////////////// SHIPPING DIVISION START ///////////////// -->

    public function divisionView(){

        $divisions = ShipDivision::orderBy('id', 'desc')->get();
        return view('backend.ship.division.view_division', compact('divisions'));

    }

    public function divisionStore(Request $request){

        $this->validate($request, [
            'division_name' => 'required',
        ],
        [
            'division_name.required' => 'Input Division Name',
        ]);

        $division = new ShipDivision();
        $division->division_name = strtoupper($request->division_name);
        $division->save();


        $notification =  array(
            'message' => 'Division Create Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-division')->with($notification);
    }

    public function divisionEdit($id){

        $division = ShipDivision::findOrFail($id);
        return view('backend.ship/division.edit_division', compact('division'));
    }

    public function divisionUpdate(Request $request, $id){

        $division = ShipDivision::findOrFail($id);
        $division->division_name = strtoupper($request->division_name);
        $division->update();

        $notification =  array(
            'message' => 'Division Update Successfully',
            'alert-type' => 'info',
        );
        return redirect()->route('manage-division')->with($notification);

    }

    public function divisionDelete($id){

        $division = ShipDivision::findOrFail($id);
        $division->delete();

        $notification =  array(
            'message' => 'Division Delete Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-division')->with($notification);
    }

    // <!-- ////////////////// SHIPPING DIVISION END ///////////////// -->

    // -------------------------------------------------------------------

    // <!-- ////////////////// SHIPPING DISTRECT START ///////////////// -->

    public function districtView(){

        $divisions = ShipDivision::orderBy('division_name', 'asc')->get();
        $districts = ShipDistrict::with('division')->orderBy('id', 'desc')->get();

        return view('backend.ship.district.view_district', compact('divisions', 'districts'));

    }

    public function districtStore(Request $request){

        $this->validate($request, [
            'district_name' => 'required',
        ],
        [
            'district_name.required' => 'Input District Name',
        ]);

        $district = new ShipDistrict();
        $district->division_id = $request->division_id;
        $district->district_name = strtoupper($request->district_name);
        $district->save();


        $notification =  array(
            'message' => 'District Create Successfssully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-district')->with($notification);
    }

    public function districtEdit($id){

        $divisions = ShipDivision::orderBy('division_name', 'asc')->get();
        $district = ShipDistrict::findOrFail($id);

        return view('backend.ship/district.edit_district', compact('district', 'divisions'));
    }

    public function districtUpdate(Request $request, $id){

        $district = ShipDistrict::findOrFail($id);

        $district->division_id = $request->division_id;
        $district->district_name = strtoupper($request->district_name);
        $district->update();

        $notification =  array(
            'message' => 'District Update Successfully',
            'alert-type' => 'info',
        );
        return redirect()->route('manage-district')->with($notification);

    }

    public function districtDelete($id){

        $district = ShipDistrict::findOrFail($id);
        $district->delete();

        $notification =  array(
            'message' => 'District Delete Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-district')->with($notification);
    }

     // <!-- ////////////////// SHIPPING DISTICT END ///////////////// -->

    // -------------------------------------------------------------------

    // <!-- ////////////////// SHIPPING STATE START ///////////////// -->

    public function stateView(){

        $divisions = ShipDivision::orderBy('division_name', 'asc')->get();
        $districts = ShipDistrict::orderBy('district_name', 'asc')->get();
        $states = ShipState::with('division','district')->orderBy('id', 'desc')->get();

        return view('backend.ship.state.view_state', compact('divisions','districts', 'states'));

    }

    public function stateStore(Request $request){

        $this->validate($request, [
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ],
        [
            'division_id.required' => 'Input Division Name',
            'district_id.required' => 'Input District Name',
            'state_name.required' => 'Input State Name',
        ]);

        $state = new ShipState();
        $state->division_id = $request->division_id;
        $state->district_id = $request->district_id;
        $state->state_name = strtoupper($request->state_name);
        $state->save();


        $notification =  array(
            'message' => 'State Create Successfssully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-state')->with($notification);
    }

    public function GetStateData($district_id) {
        $district = ShipDistrict::where('division_id', $district_id )->orderBy('district_name', 'ASC')->get();
        return json_encode($district);
    }

    public function stateEdit($id){

        $divisions = ShipDivision::orderBy('division_name', 'asc')->get();
        $districts = ShipDistrict::orderBy('district_name', 'asc')->get();
        $state = ShipState::findOrFail($id);

        return view('backend.ship.state.edit_state', compact('divisions','districts', 'state'));
    }

    public function stateUpdate(Request $request, $id){

        $state = ShipState::findOrFail($id);

        $state->division_id = $request->division_id;
        $state->district_id = $request->district_id;
        $state->state_name = strtoupper($request->state_name);
        $state->update();

        $notification =  array(
            'message' => 'State Update Successfully',
            'alert-type' => 'info',
        );
        return redirect()->route('manage-state')->with($notification);

    }

    public function stateDelete($id){

        $state = ShipState::findOrFail($id);
        $state->delete();

        $notification =  array(
            'message' => 'State Delete Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-state')->with($notification);
    }


    // <!-- ////////////////// SHIPPING STATE END ///////////////// -->
}
