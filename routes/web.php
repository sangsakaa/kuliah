<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KualisLapController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\LaporanMahasiswaController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SiacaController;
use App\Http\Controllers\SupervisiController;
use App\Http\Controllers\UserDosenController;
use App\Http\Controllers\UserManagemetController;
use App\Http\Controllers\UserPerMhsController;

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

// SCREENING
Route::get('/daftar-screening-mahasiswa', [ScreeningController::class, 'index'])->name('daftar-screening-mahasiswa');
Route::get('/screening-mahasiswa', [ScreeningController::class, 'screening'])->name('screening-mahasiswa');

Route::post('/screening-mahasiswa-jawab', [ScreeningController::class, 'screeningJawab']);

Route::get('/form-screening-mahasiswa', [ScreeningController::class, 'create'])->name('form-screening-mahasiswa');

Route::post('/form-screening-mahasiswa', [ScreeningController::class, 'store']);

Route::delete('/form-screening-mahasiswa/{screening}', [ScreeningController::class, 'destroy']);

Route::delete('/daftar-screening-mahasiswa/{mahasiswa_id}', [ScreeningController::class, 'destroy_screening']);
Route::delete('/hapus-data-file/{file_screenig}', [ScreeningController::class, 'HapusFile']);

Route::get('/laporan', [ScreeningController::class, 'LaporanPDF']);





Route::get('/validasi-screening', [ScreeningController::class, 'ValidasiScreening'])->name('validasi-screening');
Route::get('/pdf/screen/{nim}', [ScreeningController::class, 'download_pdf']);
Route::get('/view-pdf/screen', [ScreeningController::class, 'view_pdf']);
Route::post('uploud-screening-mahasiswa', [ScreeningController::class, 'uploudFile']);
Route::get('/update-validasi-pendaftaran/{file_screenig}', [ScreeningController::class, 'UpdateStatusScreening'])->middleware(['auth']);
Route::patch('/update-validasi-pendaftaran/{file_screenig}', [ScreeningController::class, 'uploudFileStatus'])->middleware(['auth']);


// userManajement
Route::get('/data-user', [UserManagemetController::class, 'UserAdmin'])->middleware(['auth'])->name('data-user');
Route::post('/create-user', [UserManagemetController::class, 'CreateUserAdmin'])->middleware(['auth']);
Route::post('/data-user', [UserManagemetController::class, 'CreateUserDosen'])->middleware(['auth']);



// 

Route::get('/akun-mahasiswa', [UserPerMhsController::class, 'User'])->middleware(['auth'])->name('akun-mahasiswa');
// sesiLap
Route::get('/sesi-laporan-mahasiswa', [UserPerMhsController::class, 'sesiLap'])->middleware(['auth'])->name('sesi-laporan-mahasiswa');
Route::post('/sesi-laporan-mahasiswa', [UserPerMhsController::class, 'createSesiLap'])->middleware(['auth'])->name('sesi-laporan-mahasiswa');
Route::get('/laporan-mahasiswa/{sesi_Laporan_Harian}', [UserPerMhsController::class, 'laporan'])->middleware(['auth'])->name('laporan-mahasiswa');
Route::post('/laporan-mahasiswa/{sesi_Laporan_Harian}', [UserPerMhsController::class, 'BuatLap'])->middleware(['auth']);
Route::get('/detail-lap-mhs', [UserPerMhsController::class, 'detailLapPerMhs'])->middleware(['auth'])->name('detail-lap-mhs');


Route::get('/rekap-laporan-mahasiswa', [UserPerMhsController::class, 'RekapLapHarian'])->middleware(['auth'])->name('rekap-laporan-mahasiswa');
Route::get('/unduh-file/{sesi_Laporan_Harian}', [UserPerMhsController::class, 'unduhFile'])
    ->name('unduh.file');


// Siaca
Route::get('/cek-laporan', [SiacaController::class, 'RekapLap'])->middleware(['auth'])->name('cek-laporan');
Route::get('/cek-valid-dosen', [SiacaController::class, 'RekapVal'])->middleware(['auth'])->name('cek-valid-dosen');
Route::get('/score-dosen', [SiacaController::class, 'ScoreDosen'])->middleware(['auth'])->name('score-dosen');
Route::get('/score-mahasiswa', [SiacaController::class, 'ScoreMhs'])->middleware(['auth'])->name('score-mahasiswa');
Route::get('/cek-tidak-laporan', [SiacaController::class, 'CekBelumLap'])->middleware(['auth'])->name('cek-tidak-laporan');

// cek kualitas Lap 
Route::get('/cek-kualitas', [KualisLapController::class, 'laporan'])->middleware(['auth'])->name('cek-kualistas');
Route::patch('/cek-kualitas', [KualisLapController::class, 'updateChec'])->middleware(['auth'])->name('cek-kualistas');
Route::get('/cek-kualitas-fix', [KualisLapController::class, 'RekLap'])->middleware(['auth'])->name('cek-kualitas-fix');


Route::get('/sesi-harian', [PresensiController::class, 'index'])->middleware(['auth'])->name('sesi-harian');
Route::get('/daftar-sesi-harian/{sesi_Harian}', [PresensiController::class, 'show'])->middleware(['auth']);
Route::post('/sesi-harian', [PresensiController::class, 'store'])->middleware(['auth'])->name('sesi-harian');
Route::post('/daftar-sesi-harian/{sesi_Harian}', [PresensiController::class, 'storeSesi'])->middleware(['auth']);
Route::get('/rekap-sesi-harian', [PresensiController::class, 'rekapPresensi'])->middleware(['auth'])->name('rekap-sesi-harian');
Route::delete('/rekap-sesi-harian/{sesi_Harian}', [PresensiController::class, 'destroy'])->middleware(['auth']);





// Role Management
Route::get('/role-management', [RoleManagementController::class, 'roleManagement'])->middleware(['auth'])->name('role-management');
Route::post('/role-management', [RoleManagementController::class, 'store'])->middleware(['auth']);
Route::get('/has-role', [RoleManagementController::class, 'HasRole'])->middleware(['auth'])->name('has-role');
Route::post('/has-role', [RoleManagementController::class, 'storeHasRole'])->middleware(['auth'])->name('has-role');
Route::delete('/has-role/{has_Role:model_id}', [RoleManagementController::class, 'RemoveRole'])->middleware(['auth']);

// User Dosen

Route::get('/sesi-validasi-laporan-mhs', [UserDosenController::class, 'validasiLaporan'])->middleware(['auth'])->name('sesi-validasi-laporan-mhs');
Route::get('/daftar-validasi-laporan-mhs/{sesi_Laporan_Harian}', [UserDosenController::class, 'DaftaValidasi'])->middleware(['auth'])->name('daftar-validasi-laporan-mhs');
Route::get('/data-anggota', [UserDosenController::class, 'dataAnggota'])->middleware(['auth'])->name('data-anggota');
Route::get('/time-line', [UserDosenController::class, 'timeLine'])->middleware(['auth'])->name('time-line');
Route::get('/rekap-laporan-mhs', [UserDosenController::class, 'rekapSesi'])->middleware(['auth'])->name('rekap-laporan-mhs');



Route::get('/supervisi-dosen', [SupervisiController::class, 'superVisi'])->middleware(['auth'])->name('supervisi-dosen');
Route::post('/supervisi-dosen', [SupervisiController::class, 'store'])->middleware(['auth']);
Route::get('/laporan-supervisi-dosen/{supervisi}', [SupervisiController::class, 'LapsuperVisi'])->middleware(['auth'])->name('laporan-supervisi-dosen');
Route::post('/laporan-supervisi-dosen/{supervisi}', [SupervisiController::class, 'StoreLapsuperVisi'])->middleware(['auth']);
Route::get('/cetak-laporan-supervisi/{supervisi}', [SupervisiController::class, 'CetakSupervisi'])->middleware(['auth']);
Route::delete('/supervisi-dosen/{supervisi}', [SupervisiController::class, 'destroy'])->middleware(['auth']);
// LAPORAN
Route::get('/laporan-harian-mahasiswa', [LaporanController::class, 'LaporanMahasiswa'])->middleware(['auth'])->name('laporan-harian-mahasiswa');



Route::get('/daftar-nilai', [NilaiController::class, 'DaftarNilai'])->middleware(['auth'])->name('daftar-nilai');
Route::post('/daftar-nilai', [NilaiController::class, 'StoreDaftar'])->middleware(['auth'])->name('daftar-nilai');
Route::get('/nilai-peserta-kkn/{daftarNilai}', [NilaiController::class, 'nilaiAkhir'])->middleware(['auth'])->name('nilai-peserta-kkn');
Route::get('/nilai-peserta-kkn/{daftarNilai}', [NilaiController::class, 'nilaiAkhir'])->middleware(['auth'])->name('nilai-peserta-kkn');
Route::post('/nilai-peserta-kkn/{daftarNilai}', [NilaiController::class, 'storeNilai'])->middleware(['auth'])->name('nilai-peserta-kkn');
Route::delete('/daftar-nilai/{daftarNilai}', [NilaiController::class, 'destroy'])->middleware(['auth']);


// KELOMPOK
Route::get('/kelompok-mahasiswa', [KelompokController::class, 'index'])->middleware(['auth'])->name('kelompok-mahasiswa');
Route::post('/kelompok-mahasiswa', [KelompokController::class, 'store']);
Route::get('/edit-kelompok-mahasiswa/{anggota_Kelompok}', [KelompokController::class, 'edit']);
Route::patch('/edit-kelompok-mahasiswa/{anggota_Kelompok}', [KelompokController::class, 'update']);
Route::get('/detail-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'view'])->middleware(['auth']);
Route::get('/kolektif-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'insert']);
Route::post('/kolektif-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'storeAnggota']);
Route::delete('/detail-kelompok-mahasiswa/{anggota_Kelompok}', [KelompokController::class, 'DestroAnggota']);
Route::delete('/kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'destroy']);
// kelompok
Route::get('/edit-kelompok/{kelompok}', [KelompokController::class, 'editKelompok']);
Route::patch('/edit-kelompok/{kelompok}', [KelompokController::class, 'updateKelompok']);


// Lokasi
Route::get('/lokasi-kabupaten', [LokasiController::class, 'index'])->name('kabupaten');
Route::get('/lokasi-kecamatan/{kabupaten}', [LokasiController::class, 'LokasiKec']);
Route::get('/lokasi-desa/{kecamatan}', [LokasiController::class, 'LokasiDes']);
Route::post('/lokasi-kabupaten', [LokasiController::class, 'createKab']);
Route::post('/lokasi-kecamatan/{kabupaten}', [LokasiController::class, 'createKec']);
Route::post('/lokasi-desa/{kecamatan}', [LokasiController::class, 'createDes']);

// Periode KKN
Route::get('/semester', [SemesterController::class, 'index'])->name('semester');
Route::get('/periode-semester', [SemesterController::class, 'indexPeriode'])->name('periode-semester');
Route::post('/semester', [SemesterController::class, 'StoreSemester'])->name('semester');
Route::post('/periode-semester', [SemesterController::class, 'StorePeriode'])->name('periode-semester');


require __DIR__ . '/auth.php';
