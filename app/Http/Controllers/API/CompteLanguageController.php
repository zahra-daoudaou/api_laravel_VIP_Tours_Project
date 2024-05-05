<?php

namespace App\Http\Controllers\API;

use App\Models\Compte;
use App\Models\Language;
use App\Models\Compte_Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompteLanguageController extends Controller
{

    public function index($id_compte)
    {
        $compte = Compte::find($id_compte);
        if (!$compte) {
            return response()->json(['message' => "Compte with ID '{$id_compte}' not found"], 404);
        }
    
        $languages = $compte->languages()->pluck('nom_language');
    
        return response()->json([
            'status' => 200,
            'compte' => $compte,
            'languages' => $languages,
        ]);
    }
 

 ///////////////////////////////////////////////////////// 


    public function addLanguage(Request $request, $id_compte, $id_language)
    {
        $compte = Compte::find($id_compte);
        if (!$compte) {
            return response()->json(['message' => "Compte with ID '{$id_compte}' not found"], 404);
        }

        $language = Language::find($id_language);
        if (!$language) {
            return response()->json(['message' => "Language with ID '{$id_language}' not found"], 404);
        }

        $compte->languages()->attach($id_language);

        return response()->json(['message' => "Language '{$language->nom_language}' added successfully"], 200);
    }


// ////////////////////////////////////


    public function removeLanguage(Request $request, $id_compte, $id_language)
    {
        $compte = Compte::find($id_compte);
        if (!$compte) {
            return response()->json(['message' => "Compte with ID '{$id_compte}' not found"], 404);
        }

        $language = Language::find($id_language);
        if (!$language) {
            return response()->json(['message' => "Language with ID '{$id_language}' not found"], 404);
        }

        $compte->languages()->detach($id_language);

        return response()->json(['message' => "Language '{$language->nom_language}' removed successfully"], 200);
    }
}

