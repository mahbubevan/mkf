<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accesories;
use App\Models\AccesoriesList;
use App\Models\Fabric;
use App\Models\Production;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function list()
    {
        $data['page_title'] = 'Production Records';
        $data['productions'] = Production::latest()->paginate(5);

        return view('admin.production.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Start A New Production';
        $data['fabrics'] = Fabric::where('status', Fabric::AVAIL)->get();
        $data['accesories'] = AccesoriesList::with('accessories')->whereHas('accessories', function ($q) {
            $q->where('status', Accesories::ACTIVE);
        })->get();

        return view('admin.production.create', $data);
    }

    public function get_production_code(Request $request)
    {
        $fabric = Fabric::where('id', $request->id)->where('status', Fabric::AVAIL)->first();
        $code = \getProductionCode($fabric->name, $fabric->expected_pant);

        return $code;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fabric_id' => 'required',
            'accesories' => 'required',
            'code' => 'required',
            'pattern_name' => 'nullable',
            'model_name' => 'nullable',
            'pant_quantity' => 'required',
            'ex_p_cost' => 'required',
            'ex_sale' => 'required',
            'image' => 'required|image',
        ]);

        $accesoriesItems = collect($request->accesories);
        foreach ($accesoriesItems as $key => $value) {
            $item = Accesories::with('accesories_name')->whereHas('accesories_name', function ($q) use ($key) {
                $q->where('name', $key);
            })
                ->where('quantity', '>=', $value)
                ->first();

            if (!$item) {
                return back()->with('error', 'You Do Not Have Enough Accesories To Start This Production');
            }

            $item->remaining -= $value;
            $item->update();
        }

        $production = new Production();
        $production->fabric_id = $request->fabric_id;
        $production->accesories_count = $request->accesories;
        $production->code = $request->code;
        $production->pattern_name = $request->pattern_name;
        $production->model_name = $request->model_name;
        $production->pant_quantity = $request->pant_quantity;
        $production->ex_p_cost = $request->ex_p_cost;
        $production->ex_sale = $request->ex_sale;
        $production->image = \uploadImage($request->image, 'img/production/');
        $production->save();

        $fabric = Fabric::where('id', $request->fabric_id)->first();
        $fabric->status = Fabric::UNAVAIL;
        $fabric->update();

        return back()->with('success', 'Production Started, Fabrics & Accesories Has Been Used');
    }

    public function show(Production $production)
    {
        $data['page_title'] = "Production Details Of - " . $production->code;

        return view('admin.production.show', $data, compact('production'));
    }

    public function partial(Request $request)
    {
        $this->validate($request, [
            'productionId' => 'required',
            'stock' => 'required'
        ]);

        $production = Production::where('id', $request->productionId)->first();
        if ($request->stock > $production->pant_quantity) {
            return back()->with('error', 'You can not stock more than your total quantity');
        }

        if (($request->stock + $production->stock) > $production->pant_quantity) {
            return back()->with('error', 'You can not stock more than your total quantity');
        }

        $production->stock += $request->stock;
        $production->update();

        $stock = new Stock();
        $stock->production_id = $production->id;
        $stock->production_code = $production->code;
        $stock->image = $production->image;
        $stock->quantity = $request->stock;
        $stock->remaining = $request->stock;
        $stock->amount = $production->ex_sale;
        $stock->save();

        if ($production->pant_quantity == $production->stock) {
            $production->status = Production::COMPLETED;
            $production->update();
        }

        return back()->with('success', 'Production Updated And New Stock Created Successfully');
    }

    public function full(Request $request)
    {
        $this->validate($request, [
            'productionId' => 'required'
        ]);

        $production = Production::where('id', $request->productionId)->first();
        $remaining_stock = $production->pant_quantity - $production->stock;
        $production->stock += $remaining_stock;
        $production->status = Production::COMPLETED;
        $production->update();

        $stock = new Stock();
        $stock->production_id = $production->id;
        $stock->production_code = $production->code;
        $stock->image = $production->image;
        $stock->quantity = $remaining_stock;
        $stock->remaining = $remaining_stock;
        $stock->amount = $production->ex_sale;
        $stock->save();


        return back()->with('success', 'Production Updated And New Stock Created Successfully');
    }
}
