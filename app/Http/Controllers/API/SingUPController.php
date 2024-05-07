<?php
namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Guide;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class SingUPController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|min:10',
            'fullName' => 'required|string|max:100',
            'phone' => 'required|string',
            'type_compte'=> 'required|string|in:utilisateur,guide',
            'country' => 'required|string',
            'city' => 'required|string',
            'photo' => 'string',
            'specialitie' => 'required_if:type_compte,guide|string', 
            'description' => 'required_if:type_compte,guide|string', 
            'cin' => 'required|string',
            'address' => 'required_if:type_Compte,utilisateur|string', 
        ]);

        
        if (Compte::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => 409, 
                'message' => 'The email adress is already in use.',
            ], 409);
        }

        // Create Compte
        $compte = new Compte();
        $compte->login = $request->login;
        $compte->email = $request->email;  
        $compte->motpass = Hash::make($request->password);
        $compte->nom = $request->fullName;
        $compte->num_tel = $request->phone; 
        $compte->type_compte = $request->type_compte;
        $compte->pays = $request->country;
        $compte->ville = $request->city;
        $compte->photo = $request->photo;
        $compte->save();

        // Create Guide or Utilisateur based on type_Compte
        if ($request->type_Compte === 'guide') {
            $guide = new Guide();
            $guide->description = $request->description;
            $guide->specialite = $request->specialitie;
            $guide->cin = $request->cin;
            $guide->id_compte = $compte->id;
            $guide->save();
        } else {
            $utilisateur = new Utilisateur();
            $utilisateur->address = $request->address;
            $utilisateur->cin = $request->cin;
            $utilisateur->id_compte = $compte->id;
            $utilisateur->save();
        }
        
        return response()->json([
            'status' => 201,
            'message' => 'Sign-up successful!',
            'compte' => $compte,
        ], 201);
    }
    
}
