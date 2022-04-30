<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;

class about extends Seeder
{
    private function body()
    {

        return "هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل جميع مولّدات نصوص لوريم إيبسوم على الإنترنت على إعادة تكرار مقاطع من نص لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية، مضاف إليها مجموعة من الجمل النموذجية، لتكوين نص لوريم إيبسوم ذو شكل منطقي قريب إلى النص الحقيقي. وبالتالي يكون النص الناتح خالي من التكرار، أو أي كلمات أو عبارات غير لائقة أو ما شابه. وهذا ما يجعله أول مولّد نص لوريم إيبسوم حقيقي على الإنترنت.";
    }
   
    private function file()
    {
        //public\site\assets\images\3lom1.jpg
        $get= public_path('site/assets/images/3lom1.jpg');
        
       $filesystem = new Filesystem;
       $name = $filesystem->name( $get );
       $extension = $filesystem->extension( $get );
       $originalName = $name . '.' . $extension;
       $mimeType = $filesystem->mimeType( $get );
       $error = null;
     
    $newFile = new UploadedFile( $get, $originalName, $mimeType, $error, true );
    $fileName = time().hash('sha256' , Str::random(120)) . '.' .$newFile->getClientOriginalExtension();
    $filePath =   $newFile->move(public_path('dashboardAdmins/images') ,$fileName  );
    File::copy( $filePath ,  $get);
       
        return  'dashboardAdmins/images/' . $fileName ;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\About::create([

            'url_img' => $this->file(),
            'body' =>$this->body(),
        ]);
      
    }
}
