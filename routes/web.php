<?php



use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\LaporanMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TestingController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/setting', [MahasiswaController::class, 'index'])->middleware(['auth'])->name('setting');
Route::get('/mahasiswa', [MahasiswaController::class, 'dataMahahsiswa'])->middleware(['auth'])->name('mahasiswa');
Route::get('/sinkronisasi', [MahasiswaController::class, 'sinkronisasi']);
Route::get('/cek-nim-ganda', [MahasiswaController::class, 'deteksiDuplikasi']);
// Route::get('/dosen-get', [DosenController::class, 'index'])->middleware(['auth']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
// dosen
Route::get('/Singkron-Dosen', [DosenController::class, 'SingkronDosen'])->middleware(['auth']);
Route::get('/data-Dosen', [DosenController::class, 'dataDosen'])->middleware(['auth'])->name('data-Dosen');
Route::delete('/data-Dosen/{dosen}', [DosenController::class, 'Destroy'])->middleware(['auth']);
Route::get('/export-excel', [MahasiswaController::class, 'exportExcel'])->middleware(['auth']);
// Program Studi
Route::get('/Singkron-Prodi', [ProdiController::class, 'SingkronProdi'])->middleware(['auth']);
Route::get('/data-Prodi', [ProdiController::class, 'dataProdi'])->middleware(['auth']);
Route::get('/get-test', [TestingController::class, 'sinkronisasi']);



// LAPORAN MAHASISWA
Route::get('/laporan-mahasiswa', [LaporanMahasiswaController::class, 'LaporanDataMahasiswa']);

// KELOMPOK

Route::get('/kelompok-mahasiswa', [KelompokController::class, 'index'])->name('kelompok-mahasiswa');
Route::post('/kelompok-mahasiswa', [KelompokController::class, 'store']);
Route::get('/detail-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'view']);
Route::get('/kolektif-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'insert']);
Route::post('/kolektif-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'storeAnggota']);
Route::delete('/detail-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'DestroAnggota']);
Route::delete('/kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'destroy']);


require __DIR__ . '/auth.php';
