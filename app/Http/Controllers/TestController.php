<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\View;


class TestController extends Controller
{
    public function viewImportFileTemplate()
    {
        return view('temp');
    }

    public function importFile(Request $request)
    {

        $strTemplateName = $request->input('template');
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls,pdf|max:2048'
        ]);
        $strFileName = $request->file('file')->getClientOriginalName();
        $request->file->move(public_path('uploads'), $strFileName);
        $strPath = public_path('uploads/' . $strFileName);
        $arrStrCsvRows = array_map('str_getcsv', file($strPath));
        unset($arrStrCsvRows[0]);
        $arrStrData = [];
        foreach ($arrStrCsvRows as $arrStrCsvRow) {
            $intUserId = DB::table('certified_users')->insertGetId([
                'user_name' => $arrStrCsvRow[0],
                'user_designation' => $arrStrCsvRow[1],
                'event_name' => $arrStrCsvRow[2],
                'registration_date' => $arrStrCsvRow[3],
                'event_date' => $arrStrCsvRow[4],
                'mobile_number' => $arrStrCsvRow[5],
                'profile_picture' => $arrStrCsvRow[6],
                'presented_by' => $arrStrCsvRow[7]
            ]);

            $arrStrData[] = [
                'id' => $intUserId,
                'name' => $arrStrCsvRow[0],
                'profile_pic' => $arrStrCsvRow[6]
            ];

//            echo $result;
//            file_get_contents(url(htmlspecialchars_decode( '/template1/'.$strFileName.'/'.$intUserId)));
//            sleep(1);
        }
        return view('generate_image', ['arrStrRows' => $arrStrData]);

        unlink($strPath);
//			return route('createImage')->with('strName',$arrStrCsvRow[0]);
//        $this->createImage($arrStrCsvRow[0], $arrStrCsvRow[4], $strTemplateName);

//			return redirect()->back()->with('success', 'Data imported successfully');

    }

    public function createImage($strName, $strEventDate, $strTemplateName)
    {

        if ($strTemplateName == 'Template-1') {
            echo "1";
            return view('template1');
        }
    }

    public function viewTemplate1($strName, $intUserId, $strProfilePic)
    {

        return view('template1', ['name' => $strName, 'id' => $intUserId, 'profile_pic' => $strProfilePic]);
    }

    public function saveImage(){
        $strImageCode = $_POST['data'];
        $strImageName = $_POST['id'].'.png';

        $ifp = fopen( public_path('/uploads/').$strImageName, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $strImageCode );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp );

        echo $strImageName;
    }


}
