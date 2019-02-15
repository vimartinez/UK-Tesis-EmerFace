package com.tfi.emerface.emerface2;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Matrix;
import android.graphics.Paint;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Environment;
import android.os.StrictMode;
import android.provider.MediaStore;
import android.support.v4.content.FileProvider;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Display;
import android.view.Gravity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.microsoft.projectoxford.face.FaceServiceClient;
import com.microsoft.projectoxford.face.FaceServiceRestClient;
import com.microsoft.projectoxford.face.contract.Face;
import com.microsoft.projectoxford.face.contract.FaceRectangle;
import com.microsoft.projectoxford.face.contract.IdentifyResult;
import com.microsoft.projectoxford.face.contract.Person;
import com.microsoft.projectoxford.face.contract.TrainingStatus;
import com.microsoft.projectoxford.face.rest.ClientException;

import org.json.JSONArray;
import org.json.JSONException;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.UUID;

import static com.tfi.emerface.emerface2.R.drawable.logo;
import static com.tfi.emerface.emerface2.R.drawable.paciente2;

public class MainActivity extends AppCompatActivity {

    private FaceServiceClient faceServiceClient = new FaceServiceRestClient("https://westcentralus.api.cognitive.microsoft.com/face/v1.0","f72f0fc759c14ad182c7581832e235a3");
    private final String personGroupId = "pac";
    public static final String PACIENTE = "com.tfi.emerface.emerface2.pacienteId";

 //   String mCurrentPhotoPath;
 //   static final int REQUEST_TAKE_PHOTO = 1;

    Button btnpic;
    ImageView imgTakenPic;
    private static final int CAM_REQUEST=1313;

    ImageView imageView;
    Bitmap mBitmap;
    Bitmap mBitmap2;
    Bitmap bitmap;
    Face[] facesDetected;
    Person persona;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        mBitmap = BitmapFactory.decodeResource(getResources(),logo);
        imageView = (ImageView)findViewById(R.id.logo);
        imageView.setImageBitmap(mBitmap);

        mBitmap2 = BitmapFactory.decodeResource(getResources(),paciente2);
        imgTakenPic = (ImageView)findViewById(R.id.imageView);
        imgTakenPic.setImageBitmap(mBitmap2);

        btnpic = (Button) findViewById(R.id.button);
        btnpic.setOnClickListener(new btnTakePhotoClicker());
    }

    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if(requestCode == CAM_REQUEST){
            bitmap = (Bitmap) data.getExtras().get("data");
            Matrix matrix = new Matrix();
            matrix.postRotate(90);
            bitmap = Bitmap.createBitmap(bitmap , 0, 0, bitmap .getWidth(), bitmap .getHeight(), matrix, true);
            imgTakenPic.setImageBitmap(bitmap);

            ByteArrayOutputStream ouputStream = new ByteArrayOutputStream();
            bitmap.compress(Bitmap.CompressFormat.JPEG,100, ouputStream);
            ByteArrayInputStream inputStream = new ByteArrayInputStream(ouputStream.toByteArray());

            new detectTask().execute(inputStream);

       }

/*
              if (requestCode == 1) {
                File imgFile = new  File(mCurrentPhotoPath);
                if(imgFile.exists()){
                    Bitmap myBitmap = BitmapFactory.decodeFile(imgFile.getAbsolutePath());
                    ImageView myImage = (ImageView) findViewById(R.id.imageView);
                    myImage.setImageBitmap(myBitmap);

                    ByteArrayOutputStream ouputStream = new ByteArrayOutputStream();
                    myBitmap.compress(Bitmap.CompressFormat.JPEG,100, ouputStream);
                    ByteArrayInputStream inputStream = new ByteArrayInputStream(ouputStream.toByteArray());

                    Bitmap bitmap = BitmapFactory.decodeResource(getResources(),R.drawable.bati3);
                    new detectTask().execute(inputStream);

                }
            }
*/

    }

    public void cambiarPantalla(View view) {
        Intent intent = new Intent(this, Main2Activity.class);

        if (persona != null){
            String pacienteId = persona.name;
            intent.putExtra(PACIENTE, pacienteId);
            startActivity(intent);
        }
        else {

            Toast toast = Toast.makeText(MainActivity.this, "Debe identificar un paciente primero.", Toast.LENGTH_SHORT);
            View toastView = toast.getView();

            TextView toastMessage = (TextView) toastView.findViewById(android.R.id.message);
            toastMessage.setTextSize(14);
            toastMessage.setTextColor(Color.BLACK);
            toastMessage.setCompoundDrawablesWithIntrinsicBounds(R.drawable.info2, 0, 0, 0);
            toastMessage.setGravity(Gravity.CENTER);
            toastMessage.setCompoundDrawablePadding(20);
            toastView.setBackgroundColor(Color.parseColor("#FAFAFA"));
            toast.setGravity(Gravity.CENTER_VERTICAL, 0, 0);
            toast.show();
        }


    }

    public void probarSrv(View view) {
        Toast toast = Toast.makeText(MainActivity.this, "Proximamente..", Toast.LENGTH_SHORT);
        View toastView = toast.getView();

        TextView toastMessage = (TextView) toastView.findViewById(android.R.id.message);
        toastMessage.setTextSize(14);
        toastMessage.setTextColor(Color.BLACK);
        toastMessage.setCompoundDrawablesWithIntrinsicBounds(R.drawable.info2, 0, 0, 0);
        toastMessage.setGravity(Gravity.CENTER);
        toastMessage.setCompoundDrawablePadding(20);
        toastView.setBackgroundColor(Color.parseColor("#FAFAFA"));
        toast.setGravity(Gravity.CENTER_VERTICAL, 0, 0);
        toast.show();

    }

    class btnTakePhotoClicker implements  Button.OnClickListener {

        @Override
        public void onClick(View view) {
            Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
            intent.putExtra(android.provider.MediaStore.EXTRA_OUTPUT, "pic.jpg");
            startActivityForResult(intent, CAM_REQUEST);

         //   dispatchTakePictureIntent();
        }
    }

    private class detectTask extends AsyncTask<InputStream, String, Face[]> {
        private ProgressDialog mDialog = new ProgressDialog(MainActivity.this);

        @Override
        protected Face[] doInBackground(InputStream... inputStreams) {
            try{
                publishProgress("Analizando imagen....");
                Face[] results = faceServiceClient.detect(inputStreams[0],true,false,null);
                if (results == null){
                    publishProgress("Detección finalizada: no se encontraron resultados");
                    return null;
                }
                else {
                    if (results.length > 0){
                        publishProgress(String.format("Se encontró %d persona",results.length));
                    }
                    else {
                        publishProgress(String.format("No se encontraron personas en la imagen"));
                    }
                    Thread.sleep(1200);
                    return results;
                }
            }
            catch (Exception ex){
                return null;
            }

        }


        @Override
        protected void onPreExecute() {
            mDialog.show();
        }

        @Override
        protected void onPostExecute(Face[] faces) {
            facesDetected = faces;
            mDialog.dismiss();


            if (facesDetected != null){
                final UUID[] facesIds = new UUID[facesDetected.length];
                if (facesDetected.length > 0){
                    for (int i=0;i<facesDetected.length;i++){
                        facesIds[i]=facesDetected[i].faceId;
                    }

                    new IdentificationTask(personGroupId).execute(facesIds);
                }
                else {
                    Toast toast = Toast.makeText(MainActivity.this, "No se pudo identificar ninguna persona", Toast.LENGTH_SHORT);
                    View toastView = toast.getView();

                    TextView toastMessage = (TextView) toastView.findViewById(android.R.id.message);
                    toastMessage.setTextSize(14);
                    toastMessage.setTextColor(Color.BLACK);
                    toastMessage.setCompoundDrawablesWithIntrinsicBounds(R.drawable.alert2, 0, 0, 0);
                    toastMessage.setGravity(Gravity.CENTER);
                    toastMessage.setCompoundDrawablePadding(20);
                    toastView.setBackgroundColor(Color.parseColor("#FAFAFA"));
                    toast.setGravity(Gravity.CENTER_VERTICAL, 0, 0);
                    toast.show();
                }
            }


        }

        @Override
        protected void onProgressUpdate(String... values) {
            mDialog.setMessage(values[0]);
        }
    }

    private class IdentificationTask extends AsyncTask<UUID,String,IdentifyResult[]> {
        String personGroupId;
        private ProgressDialog mDialog = new ProgressDialog(MainActivity.this);

        public IdentificationTask(String personGroupId){
            this.personGroupId = personGroupId;
        }

        @Override
        protected IdentifyResult[] doInBackground(UUID... uuids) {
            try{
                //     publishProgress("Obteniendo estado de grupo de personas");
                //      TrainingStatus trainingStatus = faceServiceClient.getPersonGroupTrainingStatus(this.personGroupId);
                //      if (trainingStatus.status != TrainingStatus.Status.Succeeded){
                //         publishProgress("El estado del entrenamiento del grupo es "+trainingStatus.status);
                //          return null;
                //      }
                publishProgress("Identificando Persona...");
                Thread.sleep(900);
                IdentifyResult res[] = faceServiceClient.identity(personGroupId,uuids,1);
                if (res[0].candidates.isEmpty()){
                    publishProgress("Persona no reconocida");
                    Thread.sleep(1500);
                }
                return res;
            } catch (ClientException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
            return null;
        };


        @Override
        protected void onPreExecute() {

            mDialog.show();
        }

        @Override
        protected void onPostExecute(IdentifyResult[] identifyResults) {

            if (!identifyResults[0].candidates.isEmpty()){
                for (IdentifyResult identifyResult:identifyResults)
                {
                    new PersonDetectionTask(personGroupId).execute(identifyResult.candidates.get(0).personId);
                }
            }
            mDialog.dismiss();
        }

        @Override
        protected void onProgressUpdate(String... values) {
            mDialog.setMessage(values[0]);
        }
    }

    private class PersonDetectionTask extends AsyncTask<UUID,String,Person>{
        private ProgressDialog mDialog = new ProgressDialog(MainActivity.this);
        private String personGroupId;

        public PersonDetectionTask(String personGroupId) {
            this.personGroupId = personGroupId;
        }

        @Override
        protected Person doInBackground(UUID... uuids) {
            try{
                publishProgress("Obteniendo estado de grupo de personas");

                return faceServiceClient.getPerson(personGroupId,uuids[0]);
            } catch (ClientException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPreExecute() {
            mDialog.show();
        }

        @Override
        protected void onPostExecute(Person person) {
            mDialog.dismiss();

            persona = person;
            //ImageView img =(ImageView)findViewById(R.id.imageView);
            imgTakenPic.setImageBitmap(drawFaceRectangleOnBitmap(bitmap,facesDetected,person.name));

            Toast toast = Toast.makeText(MainActivity.this, "Se identificó el paciente correctamente", Toast.LENGTH_LONG);
            View toastView = toast.getView();

            TextView toastMessage = (TextView) toastView.findViewById(android.R.id.message);
            toastMessage.setTextSize(14);
            toastMessage.setTextColor(Color.BLACK);
            toastMessage.setCompoundDrawablesWithIntrinsicBounds(R.drawable.info2, 0, 0, 0);
            toastMessage.setGravity(Gravity.CENTER);
            toastMessage.setCompoundDrawablePadding(20);
            toastView.setBackgroundColor(Color.parseColor("#FAFAFA"));
            toast.setGravity(Gravity.CENTER_VERTICAL, 0, 0);
            toast.show();
        }

        @Override
        protected void onProgressUpdate(String... values) {
            mDialog.setMessage(values[0]);
        }
    }

    private Bitmap drawFaceRectangleOnBitmap(Bitmap mBitmap, Face[] facesDetected, String name) {

        Bitmap bitmap = mBitmap.copy(Bitmap.Config.ARGB_8888,true);
        Canvas canvas = new Canvas(bitmap);

        //rectangulo
        Paint paint = new Paint();
        paint.setAntiAlias(true);
        paint.setStyle(Paint.Style.STROKE);
        paint.setColor(Color.WHITE);
        paint.setStrokeWidth(4);

        if(facesDetected != null){
            for(Face face:facesDetected){
                FaceRectangle faceRectangle = face.faceRectangle;
                canvas.drawRect(faceRectangle.left,
                        faceRectangle.top,
                        faceRectangle.left+faceRectangle.width,
                        faceRectangle.top+faceRectangle.height,
                        paint);
                //drawTextOnCanvas(canvas,20,faceRectangle.left-20, faceRectangle.top+110, Color.WHITE,name);


            }
        }
        return bitmap;
    }

    private void drawTextOnCanvas(Canvas canvas, int textSize, int x, int y, int color, String name) {
        Paint paint = new Paint();
        paint.setAntiAlias(true);
        paint.setStyle(Paint.Style.FILL);
        paint.setColor(color);
        paint.setTextSize(textSize);

        float textWidth = paint.measureText(name);

        canvas.drawText(name, x-(textWidth/2),y-(textSize/2),paint);
    }


/*
    private File createImageFile() throws IOException {
        // Create an image file name
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        String imageFileName = "JPEG_" + timeStamp + "_";
        File storageDir = getExternalFilesDir(Environment.DIRECTORY_PICTURES);
        File image = File.createTempFile(
                imageFileName,
                ".jpg",
                storageDir
        );

        // Save a file: path for use with ACTION_VIEW intents
        mCurrentPhotoPath = image.getAbsolutePath();
        return image;
    }

    private void dispatchTakePictureIntent() {
        Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        // Ensure that there's a camera activity to handle the intent
        if (takePictureIntent.resolveActivity(getPackageManager()) != null) {
            // Create the File where the photo should go
            File photoFile = null;
            try {
                photoFile = createImageFile();
            } catch (IOException ex) {
                // Error occurred while creating the File

            }
            // Continue only if the File was successfully created
            if (photoFile != null) {
                Uri photoURI = FileProvider.getUriForFile(this,
                        "com.example.android.fileprovider",
                        photoFile);
                takePictureIntent.putExtra(MediaStore.EXTRA_OUTPUT, photoURI);
                startActivityForResult(takePictureIntent, REQUEST_TAKE_PHOTO);
            }
        }
    }*/
}
