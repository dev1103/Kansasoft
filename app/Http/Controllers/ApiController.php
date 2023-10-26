<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MachineMaterial;
use App\Models\MachineType;
use App\Models\Machine;
use App\Http\Resources\MachineResource;
use App\Http\Resources\MaterialResource;

class ApiController extends Controller
{
    public function add_material(Request $request) {
        $machineMaterial = MachineMaterial::create(['name'=>$request->name]);
        if($machineMaterial) {
            return response()->json(['message'=> 'Machine material data inserted...'], 200);
        } else {
            return response()->json(['message'=> 'Something went wrong!'], 400);
        }
    }

    public function add_type(Request $request) {
        $macchineType = MachineType::create(['name'=>$request->name]);
        if($macchineType) {
            return response()->json(['message'=> 'Machine type inserted...'], 200);
        } else {
            return response()->json(['message'=> 'Something went wrong!'], 400);
        }
    }

    public function add_machine(Request $request) {
        $machineType = MachineType::find($request->type);
        if($machineType) {
            $machineMaterial = MachineMaterial::find($request->material);
            if($machineMaterial) {
                $machine = Machine::create([
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'type'=>$request->type,
                    'material'=>$request->material,
                ]);
                if($machine) {
                    return response()->json(['message'=> 'Machine inserted...'], 200);
                } else {
                    return response()->json(['message'=> 'Something went wrong!'], 400);
                }
            } else {
                return response()->json(['message'=> 'Machine material not found...'], 400);
            }
        } else {
            return response()->json(['message'=> 'Machine type not found...'], 400);
        }
    }

    public function machine_list() {
        $machine = Machine::with('materialDetail')->get();
        if($machine) {
            return response()->json(['data'=> MachineResource::collection($machine)], 200);
        } else {
            return response()->json(['message'=> 'Something went wrong!'], 400);
        }
    }

    public function machine_used_by_material() {
        $machineMaterial = MachineMaterial::with('machines')->get();
        if($machineMaterial) {
            return response()->json(['data'=> MaterialResource::collection($machineMaterial)], 200);
        } else {
            return response()->json(['message'=> 'Something went wrong!'], 400);
        }
    }

    public function type_material_count_of_machine() {
        $machine =\DB::table('tbl_machine')
                ->join('tbl_machine_type', 'tbl_machine.type', '=', 'tbl_machine_type.id')
                ->join('tbl_machine_material', 'tbl_machine_material.id', '=', 'tbl_machine.material')
                ->select('tbl_machine_type.name as type','tbl_machine_material.name as material',\DB::raw('count(tbl_machine.id) as machine'))
                ->groupBy('tbl_machine.type', 'tbl_machine_material.id')
                ->get();
        if($machine) {
            return response()->json(['data'=> $machine], 200);
        } else {
            return response()->json(['message'=> 'Something went wrong!'], 400);
        }
    }
}
