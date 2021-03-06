<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Agenda;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AgendaExport implements FromView,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {   

        // if (request('dari') || request('sampai')) {
        //     $sampai = explode('-', request('sampai'));
        //     $sampai = $sampai[0]. '-' . $sampai[1] . '-' . intval($sampai[2]) + 1;
        //     $data =  Agenda::select('agendas.name', 'agendas.materi', 'agendas.jam_pelajaran', 'agendas.jumlah_hadir', 'agendas.jumlah_tidak_hadir', 'agendas.absen', 'agendas.pembelajaran', 'agendas.link', 'agendas.image', 'agendas.keterangan', 'agendas.created_at', 'mapel.nama_mapel', 'kelas.nama_kelas')->whereBetween('agendas.created_at',[request('dari'), $sampai])
        //     ->where('user_id',auth()->user()->id)
        //     ->leftJoin('mapel', 'mapel.id', 'agendas.mapel_id')
        //     ->leftJoin('kelas', 'kelas.id', 'agendas.kelas_id')
        //     ->get();

        //     // return $data;
            
        // }else{
        //     return Agenda::all();
        // }

    // }
    
    public function view(): View
    {   
        
        if (request('dari') || request('sampai')) {
            $sampai = explode('-', request('sampai'));
            $sampai = $sampai[0]. '-' . $sampai[1] . '-' . intval($sampai[2]) + 1;
            // $data =  Agenda::select('agendas.name', 'agendas.materi', 'agendas.jam_pelajaran', 'agendas.jumlah_hadir', 'agendas.jumlah_tidak_hadir', 'agendas.absen', 'agendas.pembelajaran', 'agendas.link', 'agendas.image', 'agendas.keterangan', 'agendas.created_at', 'mapel.nama_mapel', 'kelas.nama_kelas')->whereBetween('agendas.created_at',[request('dari'), $sampai])
            // ->where('user_id',auth()->user()->id)
            // ->leftJoin('mapel', 'mapel.id', 'agendas.mapel_id')
            // ->leftJoin('kelas', 'kelas.id', 'agendas.kelas_id')
            // ->get();

            
            return view('export.excel', [
                'data' => Agenda::where('user_id',auth()->user()->id)->whereBetween('agendas.created_at',[request('dari'), $sampai])->get()
            ]);
            
        }else{
            return view('export.excel', [
                'data' => Agenda::all()->where('user_id',auth()->user()->id)
            ]);
        }  
    }
    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 12,            
            'D' => 15,
            'E' => 10,            
            'F' => 13,
            'G' => 50,            
            'H' => 14,
            'I' => 18,            
            'J' => 25,
            'K' => 20,            
            'L' => 17,            
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
    
}
