<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PetController extends Controller
{
    public function addPet()
    {
        return view('addPet');
    }

    public function submitPet(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $response = Http::post('https://petstore.swagger.io/v2/pet', [
                'name' => $request->input('name'),
                'status' => 'available'
            ]);

        } catch (RequestException|\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

        $pet = new Pet();

        $pet->pet_id = $response['id'];
        $pet->name = $response['name'];
        $pet->status = $response['status'];
        $pet->save();

        return redirect()->back()->with('success', 'Pet "'.$response->json('name').'" added successfully!');
    }

    public function pet(Request $request)
    {

        $petData = DB::table('pets')->get();

        if (!$petData) {
            return 'Cannot find any pet';
        }
        return view('pet', [
            'petData' => $petData
        ]);
    }

    public function editPet($id) {
        $pet = Pet::where('id', $id)->first();

        if (!$pet) {
            abort(404);
        }

        return view('editPet', [
            'petName' => $pet->name,
            'petId' => $pet->id,
        ]);
    }

    public function petEditSubmit(Request $request, $id) {
        $pet = Pet::where('id', $id)->first();

        if (!$pet) {
            abort(404);
        }

        try {
            Http::put('https://petstore.swagger.io/v2/pet/', ['id' => $pet->pet_id, 'name' => $request['name']]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }

        $pet->update([
            'name' => $request['name']
        ]);

        return redirect()->back()->with('success', 'Pet name updated successfully!');

    }

    public function deletePet($id){
        $pet = Pet::where('id', $id)->first();

        if (!$pet) {
            abort(404);
        }

        try {
            Http::delete('https://petstore.swagger.io/v2/pet/'.$id);
        } catch (RequestException|\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }

        $pet->delete();

        return redirect()->back()->with('success', 'Pet deleted successfully!');
    }
}
