package com.tfi.emerface.emerfaceapp;

import android.app.ProgressDialog;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.media.Image;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Gravity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import com.microsoft.projectoxford.face.FaceServiceClient;
import com.microsoft.projectoxford.face.FaceServiceRestClient;
import com.microsoft.projectoxford.face.contract.Face;
import com.microsoft.projectoxford.face.contract.FaceRectangle;
import com.microsoft.projectoxford.face.contract.IdentifyResult;
import com.microsoft.projectoxford.face.contract.Person;
import com.microsoft.projectoxford.face.contract.TrainingStatus;
import com.microsoft.projectoxford.face.rest.ClientException;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.UUID;

public class MainActivity extends AppCompatActivity {

    private FaceServiceClient faceServiceClient = new FaceServiceRestClient("https://westcentralus.api.cognitive.microsoft.com/face/v1.0","f72f0fc759c14ad182c7581832e235a3");
    private final String personGroupId = "fut";

    ImageView imageView;
    Bitmap mBitmap;
    Face[] facesDetected;
    Integer imgNumero =0;


    private class detectTask extends AsyncTask<InputStream, String, Face[]>{
        private ProgressDialog mDialog = new ProgressDialog(MainActivity.this);


        @Override
        protected Face[] doInBackground(InputStream... inputStreams) {
            try{
                publishProgress("Detectando cara....");
                Face[] results = faceServiceClient.detect(inputStreams[0],true,false,null);
                if (results == null){
                    publishProgress("Detección finalizada: no se encontraron resultados");
                    return null;
                }
                else {
                    publishProgress(String.format("Detección finalizada: %d cara(s) detectada(s)",results.length));
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
        }

        @Override
        protected void onProgressUpdate(String... values) {
            mDialog.setMessage(values[0]);
        }
    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        mBitmap = BitmapFactory.decodeResource(getResources(),R.drawable.bati3);
        imageView = (ImageView)findViewById(R.id.imageView);
        imageView.setImageBitmap(mBitmap);

        Button btnDetect = (Button)findViewById(R.id.btnDetectFace);
        Button btnIdentify = (Button)findViewById(R.id.btnIdentifyFace);
        Button btnChangeImg = (Button)findViewById(R.id.btnChangeImg);

        btnDetect.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //convertir imagen a stream
                ByteArrayOutputStream ouputStream = new ByteArrayOutputStream();
                mBitmap.compress(Bitmap.CompressFormat.JPEG,100, ouputStream);
                ByteArrayInputStream inputStream = new ByteArrayInputStream(ouputStream.toByteArray());

                new detectTask().execute(inputStream);

            }
        });

        btnIdentify.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast toast;
                if (facesDetected != null){
                    final UUID[] facesIds = new UUID[facesDetected.length];
                    if (facesDetected.length > 0){
                        for (int i=0;i<facesDetected.length;i++){
                            facesIds[i]=facesDetected[i].faceId;
                        }

                        new IdentificationTask(personGroupId).execute(facesIds);
                    }
                    else {
                        toast = Toast.makeText(MainActivity.this, "No hay personas en la imagen", Toast.LENGTH_SHORT);
                        toast.setGravity(Gravity.CENTER_VERTICAL, 0, 0);
                        toast.show();
                    }
                }
                else {
                    toast = Toast.makeText(MainActivity.this, "Debe detectar rostros primero", Toast.LENGTH_SHORT);
                    toast.setGravity(Gravity.CENTER_VERTICAL, 0, 0);
                    toast.show();
                }
            }
        });

        btnChangeImg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                switch (imgNumero){
                    case 0:
                        mBitmap = BitmapFactory.decodeResource(getResources(),R.drawable.maradona);
                        imgNumero = 1;
                        break;
                    case 1:
                        mBitmap = BitmapFactory.decodeResource(getResources(),R.drawable.messi2);
                        imgNumero = 2;
                        break;
                    case 2:
                        mBitmap = BitmapFactory.decodeResource(getResources(),R.drawable.enzo2);
                        imgNumero = 3;
                        break;
                    case 3:
                        mBitmap = BitmapFactory.decodeResource(getResources(),R.drawable.pelota);
                        imgNumero = 4;
                        break;
                    case 4:
                        mBitmap = BitmapFactory.decodeResource(getResources(),R.drawable.river);
                        imgNumero = 5;
                        break;

                        default:
                            mBitmap = BitmapFactory.decodeResource(getResources(),R.drawable.bati3);
                            imgNumero = 0;
                }

                imageView = (ImageView)findViewById(R.id.imageView);
                imageView.setImageBitmap(mBitmap);
            }
        });
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

            ImageView img =(ImageView)findViewById(R.id.imageView);
            imageView.setImageBitmap(drawFaceRectangleOnBitmap(mBitmap,facesDetected,person.name));
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
        paint.setStrokeWidth(12);

        if(facesDetected != null){
            for(Face face:facesDetected){
                FaceRectangle faceRectangle = face.faceRectangle;
                canvas.drawRect(faceRectangle.left,
                        faceRectangle.top,
                        faceRectangle.left+faceRectangle.width,
                        faceRectangle.top+faceRectangle.height,
                        paint);
                drawTextOnCanvas(canvas,100,((faceRectangle.left+faceRectangle.width)/2)+300, (faceRectangle.top+faceRectangle.height)+20, Color.WHITE,name);


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
}
