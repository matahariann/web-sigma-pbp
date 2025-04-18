<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Irs;
use App\Models\KalenderAkademik;
use App\Models\Kelas;
use App\Models\Khs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AkademikMhsController extends Controller
{
    // public function index()
    // {
    // $user = Auth::user();

    // if (!$user) {
    //     return redirect()->route('login');
    // } elseif ($user->role !== 'Mahasiswa'){
    //     return redirect()->route('home');
    // }

    // $dateNow = now();

    // $tahunAkademik = KalenderAkademik::where('keterangan', 'Periode Tahun Akademik')
    //     ->whereDate('tanggal_mulai', '<=', $dateNow)
    //     ->whereDate('tanggal_selesai', '>=', $dateNow)
    //     ->first();
    // $tahunAkademikSplit = explode('-', $tahunAkademik->tahun_akademik);
    // $tahun = (int) $tahunAkademikSplit[0];
    // $periode = (int) $tahunAkademikSplit[1] % 2;
    // $semester = $periode % 2 == 0 ? "Ganjil" : "Genap";

    // $mahasiswa = Mahasiswa::where('user_id', $user->id)->get()->first();
    // $programStudi = ProgramStudi::where('id_prodi', $mahasiswa->id_prodi)->first();
    // $mahasiswa->nama_prodi = $programStudi->nama_prodi;
    // $fakultas = Fakultas::where('id_fakultas', $programStudi->id_fakultas)->first();
    // $mahasiswa->nama_fakultas = $fakultas->nama_fakultas;
    // $mahasiswa->tahun_ajaran = ''.($tahun-$periode).'/'.($tahun-$periode+1).' '.$semester;
    // error_log($mahasiswa);

    // $jadwal = Kelas::join('mata_kuliah', 'kelas.kode_mk', '=', 'mata_kuliah.kode_mk')
    //     ->where('kelas.tahun_akademik', $tahun)
    //     // ->whereRaw('MOD(kelas.semester, 2) = ?', [1-$periode])
    //     ->join('jadwal_kuliah', 'kelas.id', '=', 'jadwal_kuliah.id_kelas')
    //     ->where('mata_kuliah.id_prodi', operator: $mahasiswa->id_prodi)
    //     ->join('ruangan', 'ruangan.id_ruang', '=', 'jadwal_kuliah.id_ruang')
    //     ->select('kelas.kode_kelas', 'kelas.kuota', 'mata_kuliah.*', 'jadwal_kuliah.*', 'ruangan.nama_ruang')
    //     ->get()
    //     ->groupBy('kode_mk')
    //     ->map(function ($group) {
    //         $mataKuliah = $group->first();
    //         $mataKuliah->jadwal_kuliah = $group->map(function ($item) {
    //             return [
    //                 'id' => $item->id,
    //                 'id_kelas' => $item->id_kelas,
    //                 'hari' => $item->hari,
    //                 'waktu_mulai' => $item->waktu_mulai,
    //                 'waktu_selesai' => $item->waktu_selesai,
    //                 'ruangan' => $item->nama_ruang,
    //                 'kelas' => $item->kode_kelas,
    //                 'kuota' => $item->kuota,
    //             ];
    //         });
    //         return [
    //             'kode_mk' => $mataKuliah->kode_mk,
    //             'nama' => $mataKuliah->nama,
    //             'sks' => $mataKuliah->sks,
    //             'semester' => $mataKuliah->semester,
    //             'jadwal_kuliah' => $mataKuliah->jadwal_kuliah,
    //             'sudah_diajukan' => $mataKuliah->diajukan,
    //         ];
    //     })
    //     ->values();
    
    // $irs = Irs::join('kelas', 'irs.id_kelas', '=', 'kelas.id')
    //     ->where('kelas.tahun_akademik', $tahun)
    //     // ->whereRaw('MOD(kelas.semester, 2) = ?', [1-$periode])
    //     ->join('mata_kuliah', 'kelas.kode_mk', '=', 'mata_kuliah.kode_mk')
    //     ->where('irs.nim', $mahasiswa->nim)
    //     ->join('jadwal_kuliah', 'jadwal_kuliah.id_kelas', '=', 'kelas.id')
    //     ->select('kelas.*', 'mata_kuliah.nama', 'mata_kuliah.sks', 'mata_kuliah.kode_mk', 'jadwal_kuliah.hari', 'jadwal_kuliah.waktu_mulai', 'jadwal_kuliah.waktu_selesai', 'irs.is_verified', 'irs.diajukan')
    //     ->get()
    //     ->groupBy('kode_mk')
    //     ->map(function ($group) {
    //         $mataKuliah = $group->first();
    //         $mataKuliah->kelas = $group->map(function ($item) {
    //             return [
    //                 'id_kelas' => $item->id,
    //                 'kelas' => $item->kode_kelas,
    //                 'kuota' => $item->kuota,
    //                 'hari' => $item->hari,
    //                 'waktu_mulai' => $item->waktu_mulai,
    //                 'waktu_selesai' => $item->waktu_selesai,
    //             ];
    //         });
    //         return [
    //             'kode_mk' => $mataKuliah->kode_mk,
    //             'nama' => $mataKuliah->nama,
    //             'sks' => $mataKuliah->sks,
    //             'selectedClass' => $mataKuliah->kelas[0],
    //             'sudah_disetujui' => $mataKuliah->is_verified,
    //             'sudah_diajukan' => $mataKuliah->diajukan,
    //         ];
    //     })
    //     ->values();
    
    // return Inertia::render('(mahasiswa)/akademik/page', ['mahasiswa' => $mahasiswa, 'jadwal' => $jadwal, 'irs' => $irs]);
    // }

    public function index()
    {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    } elseif ($user->role !== 'Mahasiswa'){
        return redirect()->route('home');
    }

    $dateNow = now();

    $tahunAkademik = KalenderAkademik::where('keterangan', 'Periode Tahun Akademik')
        ->whereDate('tanggal_mulai', '<=', $dateNow)
        ->whereDate('tanggal_selesai', '>=', $dateNow)
        ->first();
    $tahunAkademikSplit = explode('-', $tahunAkademik->tahun_akademik);
    $tahun = (int) $tahunAkademikSplit[0];
    $periode = (int) $tahunAkademikSplit[1] % 2;
    $semester = $periode % 2 == 0 ? "Ganjil" : "Genap";

    $mahasiswa = Mahasiswa::where('user_id', $user->id)->get()->first();
    $programStudi = ProgramStudi::where('id_prodi', $mahasiswa->id_prodi)->first();
    $mahasiswa->nama_prodi = $programStudi->nama_prodi;
    $fakultas = Fakultas::where('id_fakultas', $programStudi->id_fakultas)->first();
    $mahasiswa->nama_fakultas = $fakultas->nama_fakultas;
    $mahasiswa->tahun_ajaran = ''.($tahun-$periode).'/'.($tahun-$periode+1).' '.$semester;
    
    $pengisianIRS = KalenderAkademik::where('tahun_akademik', $tahunAkademik->tahun_akademik)
        ->where('keterangan', 'Pengisian IRS')
        ->first();
    $penggantianIRS = KalenderAkademik::where('tahun_akademik', $tahunAkademik->tahun_akademik)
        ->where('keterangan', 'Periode Penggantian')
        ->first();
    $pembatalanIRS = KalenderAkademik::where('tahun_akademik', $tahunAkademik->tahun_akademik)
        ->where('keterangan', 'Periode Pembatalan')
        ->first();

    $pengisianIRS->tanggal_mulai = date('Y-m-d', strtotime($pengisianIRS->tanggal_mulai));
    $pengisianIRS->tanggal_selesai = date('Y-m-d', strtotime($pengisianIRS->tanggal_selesai));
    $penggantianIRS->tanggal_mulai = date('Y-m-d', strtotime($penggantianIRS->tanggal_mulai));
    $penggantianIRS->tanggal_selesai = date('Y-m-d', strtotime($penggantianIRS->tanggal_selesai));
    $pembatalanIRS->tanggal_mulai = date('Y-m-d', strtotime($pembatalanIRS->tanggal_mulai));
    $pembatalanIRS->tanggal_selesai = date('Y-m-d', strtotime($pembatalanIRS->tanggal_selesai));
    $pengisianIRS->status = 'pengisian IRS';
    $pembatalanIRS->status = 'pembatalan IRS';
    // if ($dateNow > $pembatalanIRS->tanggal_selesai){
    //     return Inertia::render('(mahasiswa)/akademik/altPage', ['mahasiswa' => $mahasiswa, 'periode' => $pembatalanIRS]);
    // } elseif ($dateNow < $pengisianIRS->tanggal_mulai){
    //     return Inertia::render('(mahasiswa)/akademik/altPage', ['mahasiswa' => $mahasiswa, 'periode' => $pengisianIRS]);
    // }

    $ips = Khs::join('mahasiswa', 'khs.nim', '=', 'mahasiswa.nim')
        ->select(DB::raw('SUM(khs.bobot * CASE 
            WHEN khs.nilai_huruf = "A" THEN 4
            WHEN khs.nilai_huruf = "B" THEN 3
            WHEN khs.nilai_huruf = "C" THEN 2
            WHEN khs.nilai_huruf = "D" THEN 1
            ELSE 0
        END) / SUM(khs.bobot) as IPS'))
        ->where('mahasiswa.nim', $mahasiswa->nim)
        ->whereRaw('khs.semester + 1 = mahasiswa.semester')
        ->groupBy('mahasiswa.nim')
        ->first()
        ->IPS;
    $mahasiswa->ips = round($ips, 2);
    $maxSks = 0;
    $semester = $mahasiswa->semester;
    if ($semester == 1){
        $maxSks = 20;
    } elseif ($ips < 2){
        $maxSks = 18;
    } elseif ($semester == 2 || $ips < 2.5){
        $maxSks = 20;
    } elseif ($ips < 3){
        $maxSks = 22;
    } else {
        $maxSks = 24;
    }
    $mahasiswa->maxSks = $maxSks;

    $jadwal = Kelas::join('mata_kuliah', 'kelas.kode_mk', '=', 'mata_kuliah.kode_mk')
        ->where('kelas.tahun_akademik', $tahun)
        ->whereRaw('MOD(mata_kuliah.semester, 2) = ?', [1-$periode])
        ->join('jadwal_kuliah', 'kelas.id', '=', 'jadwal_kuliah.id_kelas')
        ->where('mata_kuliah.id_prodi', operator: $mahasiswa->id_prodi)
        ->join('ruangan', 'ruangan.id_ruang', '=', 'jadwal_kuliah.id_ruang')
        ->select('kelas.kode_kelas', 'kelas.kuota', 'mata_kuliah.*', 'jadwal_kuliah.*', 'ruangan.nama_ruang')
        ->get()
        ->groupBy('kode_mk')
        ->map(function ($group) {
            $mataKuliah = $group->first();
            $mataKuliah->jadwal_kuliah = $group->map(function ($item) {
                return [
                    'id' => $item->id,
                    'id_kelas' => $item->id_kelas,
                    'hari' => $item->hari,
                    'waktu_mulai' => $item->waktu_mulai,
                    'waktu_selesai' => $item->waktu_selesai,
                    'ruangan' => $item->nama_ruang,
                    'kelas' => $item->kode_kelas,
                    'kuota' => $item->kuota,
                ];
            });
            return [
                'kode_mk' => $mataKuliah->kode_mk,
                'nama' => $mataKuliah->nama,
                'sks' => $mataKuliah->sks,
                'semester' => $mataKuliah->semester,
                'jadwal_kuliah' => $mataKuliah->jadwal_kuliah,
                'sudah_diajukan' => $mataKuliah->diajukan,
            ];
        })
        ->values();
    
    $irs = Irs::join('kelas', 'irs.id_kelas', '=', 'kelas.id')
        ->where('kelas.tahun_akademik', $tahun)
        ->whereRaw('MOD(mata_kuliah.semester, 2) = ?', [1-$periode])
        ->join('mata_kuliah', 'kelas.kode_mk', '=', 'mata_kuliah.kode_mk')
        ->where('irs.nim', $mahasiswa->nim)
        ->join('jadwal_kuliah', 'jadwal_kuliah.id_kelas', '=', 'kelas.id')
        ->select('kelas.*', 'mata_kuliah.nama', 'mata_kuliah.sks', 'mata_kuliah.kode_mk', 'jadwal_kuliah.hari', 'jadwal_kuliah.waktu_mulai', 'jadwal_kuliah.waktu_selesai', 'irs.is_verified', 'irs.diajukan')
        ->get()
        ->groupBy('kode_mk')
        ->map(function ($group) {
            $mataKuliah = $group->first();
            $mataKuliah->kelas = $group->map(function ($item) {
                return [
                    'id_kelas' => $item->id,
                    'kelas' => $item->kode_kelas,
                    'kuota' => $item->kuota,
                    'hari' => $item->hari,
                    'waktu_mulai' => $item->waktu_mulai,
                    'waktu_selesai' => $item->waktu_selesai,
                ];
            });
            return [
                'kode_mk' => $mataKuliah->kode_mk,
                'nama' => $mataKuliah->nama,
                'sks' => $mataKuliah->sks,
                'selectedClass' => $mataKuliah->kelas[0],
                'sudah_disetujui' => $mataKuliah->is_verified,
                'sudah_diajukan' => $mataKuliah->diajukan,
            ];
        })
        ->values();
    
    $mahasiswa->periode_ganti = $penggantianIRS->tanggal_mulai <= $dateNow && $dateNow <= $penggantianIRS->tanggal_selesai;
    $mahasiswa->periode_ganti = $mahasiswa->periode_ganti || $pengisianIRS->tanggal_mulai <= $dateNow && $dateNow <= $pengisianIRS->tanggal_selesai;
    return Inertia::render('(mahasiswa)/akademik/page', ['mahasiswa' => $mahasiswa, 'jadwal' => $jadwal, 'irs' => $irs]);
    }

    public function insert($id_kelas){
        $kelas = Kelas::where('id', $id_kelas)->first();
        $matkul = MataKuliah::where('kode_mk', $kelas->kode_mk)->first();
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->get()->first();
        
        if ($mahasiswa->id_prodi !== $matkul->id_prodi){
            return redirect()->back()->withErrors(['error' => 'Mata kuliah tidak sesuai dengan program studi Anda.']);
        }

        $dateNow = now();

        $tahunAkademik = KalenderAkademik::where('keterangan', 'Periode Tahun Akademik')
            ->whereDate('tanggal_mulai', '<=', $dateNow)
            ->whereDate('tanggal_selesai', '>=', $dateNow)
            ->first();

        $khs = Khs::where('nim', $mahasiswa->nim)
                ->where('kode_mk', $matkul->kode_mk)
                ->orderBy('nilai_huruf', 'asc')
                ->first();

        if (is_null($khs)) {
            $status = 'Baru';
        } elseif ($khs->nilai_huruf <= 'C') {
            $status = 'Perbaikan';
        } else {
            $status = 'Ulang';
        }
        
        Irs::create([
            'id_kelas' => $id_kelas,
            'semester' => $mahasiswa->semester,
            'tahun_akademik' => $tahunAkademik->tahun_akademik,
            'status' => $status,
            'nim' => $mahasiswa->nim
        ]);

        // return redirect()->back()->with('success', 'Mata kuliah berhasil ditambahkan ke IRS.');
    }

    public function delete($id_kelas){
        $kelas = Kelas::where('id', $id_kelas)->first();
        $matkul = MataKuliah::where('kode_mk', $kelas->kode_mk)->first();
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->get()->first();
        
        if ($mahasiswa->id_prodi !== $matkul->id_prodi){
            return redirect()->back()->withErrors(['error' => 'Mata kuliah tidak sesuai dengan program studi Anda.']);
        }
        
        Irs::where('id_kelas', $id_kelas)
            ->where('nim', $mahasiswa->nim)
            ->delete();
    }

    public function ubahstatus(){
        $user = Auth::user();

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->get()->first();
        $disetujui = Irs::where('nim', $mahasiswa->nim)
                ->where('semester', $mahasiswa->semester)
                ->first()
                ->is_verified;
        if ($disetujui === 1){
            return redirect()->back()->withErrors(['error' => 'IRS Sudah Disetujui.']);
        }
        $status = Irs::where('nim', $mahasiswa->nim)
            ->where('semester', $mahasiswa->semester)
            ->first()
            ->diajukan;
        Irs::where('nim', $mahasiswa->nim)
            ->where('semester', $mahasiswa->semester)
            ->update(['diajukan' => 1-$status]);
    }
}
