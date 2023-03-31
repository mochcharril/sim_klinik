<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Checkup;
use App\Models\Recipe;
use App\Models\RecipeDetail;
use App\Models\Medicine;
use App\Models\MedicineRule;

class RecipeController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:dokter']);
    }

    public function index(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.id', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as doctor_nurse_name', 'checkups.complaint', 'checkups.height', 'checkups.weight', 'checkups.blood_preasure', 'checkups.allergy', 'checkups.diagnosis', 'checkups.measures', 'polies.name as poly_name', 'checkups.checkup_date', 'checkups.status_rm')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'checkups.doctor_nurse_id', 'users.id')
                                            ->join('polies', 'checkups.poly_id', 'polies.id')
                                            ->get();
            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            // dd($this->param['getCheckup']);
            $this->param['getRecipe'] = Recipe::all();

            return view('doctor.pages.recipe.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(Checkup $checkup){
        try {
            $this->param['generateCodeRP'] = Recipe::generateCodeRP();
            $this->param['getDetailPatient'] = Patient::find($checkup->patient_id);
            $this->param['getDetailCheckup'] = Checkup::find($checkup->id);
            $this->param['getMedicine'] = Medicine::all();
            $this->param['getMedicineRule'] = MedicineRule::all();

            return view('doctor.pages.recipe.add', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function store(Request $request, Checkup $checkup){
        $this->validate($request,
            [
                'code_rp' => 'required',
                'date_recipe' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
                'not_in' => ':attribute harus dipilih.',
            ],
            [
                'code_rp' => 'Kode Transaksi Resep',
                'date_recipe' => 'Tanggal Pemberian Resep',
            ]
        );
        try {
            $lengthRecipe = count($request->get('stock_out'));

            $recipe = new Recipe();
            $recipe->code_rp = $request->get('code_rp');
            $recipe->checkup_id = $checkup->id;
            $recipe->doctor_id = auth()->user()->id;
            $tempTotal = 0;
            for ($x=0; $x < $lengthRecipe; $x++) { 
                $tempSubTotal = (int)$request->get('price')[$x] * (int)$request->get('stock_out')[$x];
                $tempTotal+=$tempSubTotal;
            }
            $recipe->total = $tempTotal;
            $recipe->date_recipe = $request->get('date_recipe');
            $recipe->save();

            for ($y=0; $y < $lengthRecipe; $y++) { 
                $recipeDetail = new RecipeDetail();
                $recipeDetail->recipe_id = $recipe->id;
                $recipeDetail->medicine_id = $request->get('medicine')[$y];
                $recipeDetail->medication_rules = $request->get('medication_rules')[$y];
                $recipeDetail->qty = $request->get('stock_out')[$y];
                $recipeDetail->total = (int)$request->get('price')[$y] * (int)$request->get('stock_out')[$y];
                $recipeDetail->save();

                $updateMedicine = Medicine::find($request->get('medicine')[$y]);
                $updateMedicine->stock = $request->get('stock')[$y] - $request->get('stock_out')[$y];
                $updateMedicine->save();
            }

            $updateCheckup = Checkup::find($checkup->id);
            $updateCheckup->status_rm = '1';
            $updateCheckup->save();

            return redirect('/doctor/action/recipe')->withStatus('Berhasil menambahkan resep.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function detail(Checkup $checkup){
        try {
            $this->param['getDetailPatient'] = Patient::find($checkup->patient_id);
            $this->param['getDetailCheckup'] = Checkup::find($checkup->id);
            $this->param['getMedicine'] = Medicine::all();
            $this->param['getMedicineRule'] = MedicineRule::all();
            $this->param['getDetailRecipe'] = \DB::table('recipe_details')
                                                ->select('recipes.code_rp', 'recipes.date_recipe', 'users.name as doctor_name', 'medicines.name as medicine_name', 'recipe_details.qty', 'recipe_details.medication_rules', 'recipe_details.total')
                                                ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                                ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                                ->join('users', 'recipes.doctor_id', 'users.id')
                                                ->where('recipes.checkup_id', $checkup->id)
                                                ->get();

            return view('doctor.pages.recipe.detail', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
