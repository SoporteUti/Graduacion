<?php
namespace sispg\Http\Controllers;

use Alert;
use sispg\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use sispg\Utils\UtilFunctions;
use Artisan;
use Log;
use Carbon\Carbon;
use Storage;
use DB;
use Schema;
set_time_limit(300);

class BackupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);

        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];
        foreach ($files as $k => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => UtilFunctions::humanFilesize($disk->size($f)),
                    'last_modified' =>  Carbon::createFromTimestamp($disk->lastModified($f)),
                    'file_age' =>  $disk->lastModified($f),
                ];
            }
        }
        $backups = array_reverse($backups);
     

        return view("ues.backups.index")->with(compact('backups'));
    }

    public function create()
    {



        try {
            $dbhost = 'localhost';
$dbname = 'pgues';
$dbuser = 'apgues';
$dbpass = 'apgues';
 
$backup_file = $dbname ."-".date("d-m-Y-H-i-s") . '.sql';
 
// comandos a ejecutar

\Spatie\DbDumper\Databases\PostgreSql::create()
 ->setDbName($dbname)
   ->setUserName($dbuser)
    ->setPassword($dbpass)
    
    ->dumpToFile("storage/DB/$backup_file");




            Artisan::call('backup:run', ['--only-files' => 'true']);
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            $notificacion = array(
            'message' => 'Backup creado con Exito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }



    public function deleteDB(Request $request){

  if($request->file('backup')!=null){
      $archivoRecibido=$_FILES["backup"]["tmp_name"];


//$delete ="psql -U apgues -c 'drop database pgues'";
  //system($delete); 
$command = "psql -1 pgues < $archivoRecibido";
system($command);

 
}
$notificacion = array(
            'message' => 'La actividad se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('laravel-backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            ob_end_clean();
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "EL Archivo de Respaldo no Existe.");
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists(config('laravel-backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "EL Archivo de Respaldo no Existe.");
        }
    }

    public function update_table()
    {
        $uf= new UtilFunctions();
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $files = $disk->files(config('backup.backup.name'));
        $backups = [];
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                    'file_age' => $disk->lastModified($f),
                ];
            }
        }
        $backups = array_reverse($backups);
        return response()->json(compact('backups'));
    }
}