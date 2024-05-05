<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* ---------------------------------------- */
// THE CONTROLLERS FOR MY ROUTES
/* ---------------------------------------- */
use App\Http\Controllers\API\CompteController;
use App\Http\Controllers\API\LanguageController;
use App\Http\Controllers\API\CompteLanguageController;
use App\Http\Controllers\API\UtilisateurController;
use App\Http\Controllers\API\GuideController;
use App\Http\Controllers\API\GalerieController;
use App\Http\Controllers\API\TemoignageController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\CommentaireController;
use App\Http\Controllers\API\FavorieController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\TourController;
use App\Http\Controllers\API\PhotoController;
use App\Http\Controllers\API\DistinationController;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\API\TransportController;
/* ---------------------------------------- */
use App\Http\Controllers\API\BlogTagController;
use App\Http\Controllers\API\PlanController;
use App\Http\Controllers\API\ServiceController;
/* ---------------------------------------- */
use App\Http\Controllers\API\TourDistinationController;
use App\Http\Controllers\API\TourHotelController;
use App\Http\Controllers\API\TourTransportController;
/* ---------------------------------------- */
use App\Http\Controllers\API\BoitDialogueController;
/* ---------------------------------------- */

/* ---------------------------------------- */
// THE ROUTES
/* ---------------------------------------- */

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/comptes
// http://localhost:8000/api/compte/create
// http://localhost:8000/api/compte/{id}
// http://localhost:8000/api/compte/update/{id}
// http://localhost:8000/api/compte/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('comptes', [CompteController::class,'index']);
Route::post('compte/create', [CompteController::class,'store']);
Route::get('compte/{id}', [CompteController::class,'show']);
Route::put('compte/update/{id}', [CompteController::class,'update']);
Route::delete('compte/delete/{id}', [CompteController::class,'destroy']);
//Route::get('compte/edit/{id}', [CompteController::class,'edit']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/languages
// http://localhost:8000/api/language/create
// http://localhost:8000/api/language/{id}
// http://localhost:8000/api/language/update/{id}
// http://localhost:8000/api/language/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('languages', [LanguageController::class,'index']);
Route::post('language/create', [LanguageController::class,'store']);
Route::get('language/{id}', [LanguageController::class,'show']);
Route::put('language/update/{id}', [LanguageController::class,'update']);
Route::delete('language/delete/{id}', [LanguageController::class,'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/languages-of-compte/{id_compte}
// http://localhost:8000/api/compte/{id_compte}/language/{id_language}/add
// http://localhost:8000/api/compte/{id_compte}/language/{id_language}/remove
/* -------------------------------------------------------------------------------- */
Route::get('languages-of-compte/{id_compte}', [CompteLanguageController::class,'index']);
Route::post('compte/{id_compte}/language/{id_language}/add', [CompteLanguageController::class, 'addLanguage']);
Route::delete('compte/{id_compte}/language/{id_language}/remove', [CompteLanguageController::class, 'removeLanguage']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/utilisateurs
// http://localhost:8000/api/utilisateur/create
// http://localhost:8000/api/utilisateur/{id}
// http://localhost:8000/api/utilisateur/update/{id}
// http://localhost:8000/api/utilisateur/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('utilisateurs', [UtilisateurController::class, 'index']);
Route::post('utilisateur/create', [UtilisateurController::class, 'store']);
Route::get('utilisateur/{id}', [UtilisateurController::class, 'show']);
Route::put('utilisateur/update/{id}', [UtilisateurController::class, 'update']);
Route::delete('utilisateur/delete/{id}', [UtilisateurController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/guides
// http://localhost:8000/api/guide/create
// http://localhost:8000/api/guide/{id}
// http://localhost:8000/api/guide/update/{id}
// http://localhost:8000/api/guide/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('guides', [GuideController::class, 'index']);
Route::post('guide/create', [GuideController::class, 'store']);
Route::get('guide/{id}', [GuideController::class, 'show']);
Route::put('guide/update/{id}', [GuideController::class, 'update']);
Route::delete('guide/delete/{id}', [GuideController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/galeries
// http://localhost:8000/api/galerie/create
// http://localhost:8000/api/galerie/{id}
// http://localhost:8000/api/galerie/update/{id}
// http://localhost:8000/api/galerie/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('galeries', [GalerieController::class, 'index']);
Route::post('galerie/create', [GalerieController::class, 'store']);
Route::get('galerie/{id}', [GalerieController::class, 'show']);
Route::put('galerie/update/{id}', [GalerieController::class, 'update']);
Route::delete('galerie/delete/{id}', [GalerieController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/temoignages
// http://localhost:8000/api/temoignage/create
// http://localhost:8000/api/temoignage/{id}
// http://localhost:8000/api/temoignage/update/{id}
// http://localhost:8000/api/temoignage/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('temoignages', [TemoignageController::class, 'index']);
Route::post('temoignage/create', [TemoignageController::class, 'store']);
Route::get('temoignage/{id}', [TemoignageController::class, 'show']);
Route::put('temoignage/update/{id}', [TemoignageController::class, 'update']);
Route::delete('temoignage/delete/{id}', [TemoignageController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/blogs
// http://localhost:8000/api/blog/create
// http://localhost:8000/api/blog/{id}
// http://localhost:8000/api/blog/update/{id}
// http://localhost:8000/api/blog/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('blogs', [BlogController::class, 'index']);
Route::post('blog/create', [BlogController::class, 'store']);
Route::get('blog/{id}', [BlogController::class, 'show']);
Route::put('blog/update/{id}', [BlogController::class, 'update']);
Route::delete('blog/delete/{id}', [BlogController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/commentaires
// http://localhost:8000/api/commentaire/create
// http://localhost:8000/api/commentaire/{id}
// http://localhost:8000/api/commentaire/update/{id}
// http://localhost:8000/api/commentaire/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('commentaires', [CommentaireController::class, 'index']);
Route::post('commentaire/create', [CommentaireController::class, 'store']);
Route::get('commentaire/{id}', [CommentaireController::class, 'show']);
Route::put('commentaire/update/{id}', [CommentaireController::class, 'update']);
Route::delete('commentaire/delete/{id}', [CommentaireController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/favories
// http://localhost:8000/api/favorie/create
// http://localhost:8000/api/favorie/{id}
// http://localhost:8000/api/favorie/update/{id}
// http://localhost:8000/api/favorie/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('favories', [FavorieController::class, 'index']);
Route::post('favorie/create', [FavorieController::class, 'store']);
Route::get('favorie/{id}', [FavorieController::class, 'show']);
Route::put('favorie/update/{id}', [FavorieController::class, 'update']);
Route::delete('favorie/delete/{id}', [FavorieController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/tags
// http://localhost:8000/api/tag/create
// http://localhost:8000/api/tag/{id}
// http://localhost:8000/api/tag/update/{id}
// http://localhost:8000/api/tag/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('tags', [TagController::class, 'index']);
Route::post('tag/create', [TagController::class, 'store']);
Route::get('tag/{id}', [TagController::class, 'show']);
Route::put('tag/update/{id}', [TagController::class, 'update']);
Route::delete('tag/delete/{id}', [TagController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/tours
// http://localhost:8000/api/tours/create
// http://localhost:8000/api/tours/{id}
// http://localhost:8000/api/tours/update/{id}
// http://localhost:8000/api/tours/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('tours', [TourController::class, 'index']);
Route::post('tour/create', [TourController::class, 'store']);
Route::get('tour/{id}', [TourController::class, 'show']);
Route::put('tour/update/{id}', [TourController::class, 'update']);
Route::delete('tour/delete/{id}', [TourController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/photos
// http://localhost:8000/api/photo/create
// http://localhost:8000/api/photo/{id}
// http://localhost:8000/api/photo/update/{id}
// http://localhost:8000/api/photo/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('photos', [PhotoController::class, 'index']);
Route::post('photo/create', [PhotoController::class, 'store']);
Route::get('photo/{id}', [PhotoController::class, 'show']);
Route::put('photo/update/{id}', [PhotoController::class, 'update']);
Route::delete('photo/delete/{id}', [PhotoController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/distinations
// http://localhost:8000/api/distination/create
// http://localhost:8000/api/distination/{id}
// http://localhost:8000/api/distination/update/{id}
// http://localhost:8000/api/distination/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('distinations', [DistinationController::class, 'index']);
Route::post('distination/create', [DistinationController::class, 'store']);
Route::get('distination/{id}', [DistinationController::class, 'show']);
Route::put('distination/update/{id}', [DistinationController::class, 'update']);
Route::delete('distination/delete/{id}', [DistinationController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/hotels
// http://localhost:8000/api/hotel/create
// http://localhost:8000/api/hotel/{id}
// http://localhost:8000/api/hotel/update/{id}
// http://localhost:8000/api/hotel/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('hotels', [hotelController::class, 'index']);
Route::post('hotel/create', [hotelController::class, 'store']);
Route::get('hotel/{id}', [hotelController::class, 'show']);
Route::put('hotel/update/{id}', [hotelController::class, 'update']);
Route::delete('hotel/delete/{id}', [hotelController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/transports
// http://localhost:8000/api/transport/create
// http://localhost:8000/api/transport/{id}
// http://localhost:8000/api/transport/update/{id}
// http://localhost:8000/api/transport/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('transports', [TransportController::class, 'index']);
Route::post('transport/create', [TransportController::class, 'store']);
Route::get('transport/{id}', [TransportController::class, 'show']);
Route::put('transport/update/{id}', [TransportController::class, 'update']);
Route::delete('transport/delete/{id}', [TransportController::class, 'destroy']);


// //////////////////////////////////////////////////////////

/* -------------------------------------------------------------------------------- */
// للحصول على الوجهات الخاصة برحلة معينة
// http://localhost:8000/api/distinations-of-tour/{id_tour}
// لإضافة وجهة إلى رحلة معينة 
// http://localhost:8000/api/tour/{id_tour}/distination/{id_distination}/add
// لمسح وجهة من رحلة معينة
// http://localhost:8000/api/tour/{id_tour}/distination/{id_distination}/remove
/* -------------------------------------------------------------------------------- */
Route::get('distinations-of-tour/{id_tour}', [TourDistinationController::class,'index']);
Route::post('tour/{id_tour}/distination/{id_distination}/add', [TourDistinationController::class, 'addDistination']);
Route::delete('tour/{id_tour}/distination/{id_distination}/remove', [TourDistinationController::class, 'removeDistination']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/hotels-of-tour/{id_tour}
// http://localhost:8000/api/tour/{id_tour}/hotel/{id_hotel}/add
// http://localhost:8000/api/tour/{id_tour}/hotel/{id_hotel}/remove
/* -------------------------------------------------------------------------------- */
Route::get('hotels-of-tour/{id_tour}', [TourHotelController::class,'index']);
Route::post('tour/{id_tour}/hotel/{id_hotel}/add', [TourHotelController::class, 'addDistination']);
Route::delete('tour/{id_tour}/hotel/{id_hotel}/remove', [TourHotelController::class, 'removeDistination']);


/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/transports-of-tour/{id_tour}
// http://localhost:8000/api/tour/{id_tour}/transport/{id_transport}/add
// http://localhost:8000/api/tour/{id_tour}/transport/{id_transport}/remove
/* -------------------------------------------------------------------------------- */
Route::get('transports-of-tour/{id_tour}', [TourTransportController::class,'index']);
Route::post('tour/{id_tour}/transport/{id_transport}/add', [TourTransportController::class, 'addDistination']);
Route::delete('tour/{id_tour}/transport/{id_transport}/remove', [TourTransportController::class, 'removeDistination']);


/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/tags-of-blog/{id_blog}
// http://localhost:8000/api/blog/{id_blog}/tag/{id_tag}/add
// http://localhost:8000/api/blog/{id_blog}/tag/{id_tag}/remove
/* -------------------------------------------------------------------------------- */
Route::get('tags-of-blog/{id_blog}', [BlogTagController::class,'index']);
Route::post('blog/{id_blog}/tag/{id_tag}/add', [BlogTagController::class, 'addDistination']);
Route::delete('blog/{id_blog}/tag/{id_tag}/remove', [BlogTagController::class, 'removeDistination']);


// //////////////////////////////////////////////////////////


/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/plans
// http://localhost:8000/api/plan/create
// http://localhost:8000/api/plan/{id}
// http://localhost:8000/api/plan/update/{id}
// http://localhost:8000/api/plan/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('plans', [PlanController::class, 'index']);
Route::post('plan/create', [PlanController::class, 'store']);
Route::get('plan/{id}', [PlanController::class, 'show']);
Route::put('plan/update/{id}', [PlanController::class, 'update']);
Route::delete('plan/delete/{id}', [PlanController::class, 'destroy']);

/* -------------------------------------------------------------------------------- */
// http://localhost:8000/api/services
// http://localhost:8000/api/service/create
// http://localhost:8000/api/service/{id}
// http://localhost:8000/api/service/update/{id}
// http://localhost:8000/api/service/delete/{id}
/* -------------------------------------------------------------------------------- */
Route::get('services', [ServiceController::class, 'index']);
Route::post('service/create', [ServiceController::class, 'store']);
Route::get('service/{id}', [ServiceController::class, 'show']);
Route::put('service/update/{id}', [ServiceController::class, 'update']);
Route::delete('service/delete/{id}', [ServiceController::class, 'destroy']);


// //////////////////////////////////////////////////////////


Route::get('boites-dialogues', [BoitDialogueController::class, 'index']);
Route::post('boite-dialogue', [BoitDialogueController::class, 'store']);
Route::get('boite-dialogue/{id}', [BoitDialogueController::class, 'show']);
Route::put('boite-dialogue/update/{id}', [BoitDialogueController::class, 'update']);
Route::delete('boite-dialogue/delete/{id}', [BoitDialogueController::class, 'destroy']);



// //////////////////////////////////////////////////////////

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
