<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewListenSessionController;
use App\Http\Controllers\ImportantLinkController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HelpUsController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaCenterController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\TenderController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whichf
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {


  Route::get('/', [HomeController::class, 'index'])->name('home');
  Route::get('/filter-products', [HomeController::class, 'filterProducts'])->name('filter.products');
  Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');

  Route::get('/menu/filter', [MenuController::class, 'filterProducts'])->name('menu.filter');
  // Menu & Product
  Route::get('/menu',                [MenuController::class, 'index'])->name('menu');
  Route::get('/product/{id}',        [MenuController::class, 'show'])->name('product.show');
  // Frontend Page Routes
  Route::get('/contact-us', function () {
    $setting = \App\Models\Setting::first();
    return view('user.contact-us', compact('setting'));
  })->name('front.contact');

  Route::get('/terms-and-conditions', function () {
    $page = \App\Models\Page::where('type', 1)->first();
    if (!$page) {
      return view('user.not-found');
    }
    return view('user.page', compact('page'));
  })->name('front.page.terms');

  Route::get('/privacy-policy', function () {
    $page = \App\Models\Page::where('type', 2)->first();
    if (!$page) {
      return view('user.not-found');
    }
    return view('user.page', compact('page'));
  })->name('front.page.privacy');

  Route::get('/stream-video/{filename}', function ($filename) {
    $path = base_path('assets/admin/uploads/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $size     = filesize($path);
    $start    = 0;
    $end      = $size - 1;
    $status   = 200;

    $headers = [
        'Content-Type'              => 'video/mp4',
        'Accept-Ranges'             => 'bytes',
        'Cache-Control'             => 'public, max-age=86400',
        'Content-Disposition'       => 'inline',
    ];

    if (request()->hasHeader('Range')) {
        preg_match('/bytes=(\d+)-(\d*)/', request()->header('Range'), $m);
        $start  = (int) $m[1];
        $end    = isset($m[2]) && $m[2] !== '' ? (int) $m[2] : $size - 1;
        $end    = min($end, $size - 1);
        $length = $end - $start + 1;
        $status = 206;
        $headers['Content-Range']  = "bytes {$start}-{$end}/{$size}";
        $headers['Content-Length'] = $length;
    } else {
        $headers['Content-Length'] = $size;
    }

    $s = $start;
    $e = $end;

    return response()->stream(function () use ($path, $s, $e) {
        $fp     = fopen($path, 'rb');
        $left   = $e - $s + 1;
        fseek($fp, $s);
        while (!feof($fp) && $left > 0) {
            $chunk = min(1024 * 256, $left);
            echo fread($fp, $chunk);
            $left -= $chunk;
            flush();
        }
        fclose($fp);
    }, $status, $headers);
})->name('stream.video');

});
