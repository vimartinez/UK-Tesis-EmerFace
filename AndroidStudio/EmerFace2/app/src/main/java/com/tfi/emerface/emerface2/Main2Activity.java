package com.tfi.emerface.emerface2;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Html;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Arrays;

import static com.tfi.emerface.emerface2.R.drawable.paciente2;

public class Main2Activity extends AppCompatActivity {

    //private static final String urlSrv = "http://192.168.0.131/"; //red local
    //private static final String urlSrv = "http://192.168.0.188/"; //red local wireless
    private static final String urlSrv = "http://192.168.43.221/"; //red telefono
    private String url = null;
    private String pacienteId = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

        Intent intent = getIntent();
        pacienteId = intent.getStringExtra(MainActivity.PACIENTE);

        url = urlSrv +"srv/srvEmerFace.php?metodo=getPaciente&pacId="+pacienteId;
        RequestQueue queque = Volley.newRequestQueue(this);

        StringRequest request = new StringRequest (url,new Response.Listener<String>(){
            @Override
            public void onResponse(String response){
                try {
                    JsonObject jsonObject = new JsonParser().parse(response).getAsJsonObject();
                    JsonArray jsonArray = jsonObject.getAsJsonArray("resultados");

                    TextView nombreApe = (TextView) findViewById(R.id.nombrePaciente);
                    nombreApe.setText(jsonArray.get(1).getAsString());
                    TextView documento = (TextView) findViewById(R.id.docuPaciente);
                    documento.setText("DNI:"+jsonArray.get(7).getAsString());
                    TextView grpSang = (TextView) findViewById(R.id.grpSang);
                    grpSang.setText(grpSang.getText()+" "+jsonArray.get(8).getAsString());
                    TextView fecNac = (TextView) findViewById(R.id.fecNac);
                    fecNac.setText(fecNac.getText()+" "+jsonArray.get(9).getAsString());

                   // TextView detalle = (TextView) findViewById(R.id.patolPaciente);
                   // String detallePaciente  = "Fecha de nacimiento: <b>" + jsonArray.get(9).getAsString() + "</b> Grupo sangíneo: <b>" + jsonArray.get(8).getAsString() + "</b>";
                  //  detalle.setText(Html.fromHtml(detallePaciente));
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error){
            }
        }
        );
        queque.add(request);

        url = urlSrv +"srv/srvEmerFace.php?metodo=getImgPaciente&pacId="+pacienteId;
        RequestQueue queque2 = Volley.newRequestQueue(this);
        StringRequest request2 = new StringRequest (url,new Response.Listener<String>(){
            @Override
            public void onResponse(String response){
                try {
                    JsonObject jsonObject = new JsonParser().parse(response).getAsJsonObject();

                    ImageView imageView;
                    imageView = (ImageView)findViewById(R.id.imageView2);
                    Bitmap mBitmap2;

                    String strUrl = urlSrv + jsonObject.get("resultados").getAsString();
                    URL imageUrl = new URL(strUrl);
                    HttpURLConnection conn = (HttpURLConnection) imageUrl.openConnection();
                    conn.connect();
                    mBitmap2 = BitmapFactory.decodeStream(conn.getInputStream());
                    imageView.setImageBitmap(mBitmap2);
                } catch (IOException e){
                    throw new RuntimeException(e);
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error){

            }
        }
        );
        queque2.add(request2);

        url = urlSrv +"srv/srvEmerFace.php?metodo=getPatologiasPaciente&pacId="+pacienteId;
        RequestQueue queque3 = Volley.newRequestQueue(this);
        StringRequest request3 = new StringRequest (url,new Response.Listener<String>(){
            @Override
            public void onResponse(String response){
                try {
                    JsonObject jsonObject = new JsonParser().parse(response).getAsJsonObject();
                    String str= "";
                    if (jsonObject.get("mensaje") != null){
                        str = "<br>"+jsonObject.get("mensaje").toString();
                    }
                    else {
                        JsonArray jsonArray = jsonObject.getAsJsonArray("resultados");
                        JsonArray jsonArray2 = null;
                        str = "<br><br>El paciente no registra patologías críticas";
                        String patolog = "";

                        for (int i = 0; i < jsonArray.size(); i++){
                            jsonArray2 = jsonArray.get(i).getAsJsonArray();
                            if (jsonArray2.get(5).getAsString().equals("1")){
                                str = "<br><br><b>ATENCIÓN:</b> Paciente con patología crítica:<br>";
                                patolog = patolog + " <b>" + jsonArray2.get(3).getAsString() + "</b><br> ";
                            }
                        }
                        str = str.concat(patolog);
                    }

                    TextView detalle = (TextView) findViewById(R.id.patolPaciente);
                    String detallePaciente = (detalle.getText().toString());
                    detalle.setText(Html.fromHtml(detallePaciente.concat(str)));

                }  catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error){

            }
        }
        );
        queque3.add(request3);
    }

    public void nuevaBusqueda(View view) {
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);
    }

    public void verPatologias(View view) {
        url = urlSrv +"srv/srvEmerFace.php?metodo=getPatologiasPaciente&pacId="+pacienteId;
        RequestQueue queque = Volley.newRequestQueue(this);
        StringRequest request = new StringRequest (url,new Response.Listener<String>(){
            @Override
            public void onResponse(String response){
                try {
                    JsonObject jsonObject = new JsonParser().parse(response).getAsJsonObject();
                    String str;
                    if (jsonObject.get("mensaje") != null){
                        str = "<br>"+jsonObject.get("mensaje").toString();
                    }
                    else {
                        JsonArray jsonArray = jsonObject.getAsJsonArray("resultados");
                        JsonArray jsonArray2 = null;
                        str =  "<br><br><b>Patologías registradas:</b><br>";
                        for (int i = 0; i < jsonArray.size(); i++){
                            jsonArray2 = jsonArray.get(i).getAsJsonArray();
                            str = str + jsonArray2.get(3).getAsString();
                            if (jsonArray2.get(5).getAsString().equals("1")){
                                str = str + " - Crítica";
                            }
                            str = str + "<br>";
                        }
                    }

                    TextView detalle = (TextView) findViewById(R.id.patolPaciente);
                    String detallePaciente = (detalle.getText().toString());
                    detalle.setText(Html.fromHtml(str));
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error){
            }
        }
        );
        queque.add(request);
    }

    public void verPersonasDeContacto(View view) {
        url = urlSrv +"srv/srvEmerFace.php?metodo=getPersContPaciente&pacId="+pacienteId;
        RequestQueue queque = Volley.newRequestQueue(this);
        StringRequest request = new StringRequest (url,new Response.Listener<String>(){
            @Override
            public void onResponse(String response){
                try {
                    JsonObject jsonObject = new JsonParser().parse(response).getAsJsonObject();
                    String str;
                    TextView detalle = (TextView) findViewById(R.id.patolPaciente);
                    if (jsonObject.get("mensaje") != null){
                        str = "<br>"+jsonObject.get("mensaje").toString();
                    }
                    else {
                        JsonArray jsonArray = jsonObject.getAsJsonArray("resultados");
                        JsonArray jsonArray2 = null;
                        str =  "<br><br><b>Personas de contacto registradas:</b><br>";
                        for (int i = 0; i < jsonArray.size(); i++){
                            jsonArray2 = jsonArray.get(i).getAsJsonArray();
                            str = str + jsonArray2.get(2).getAsString()+" - "+ jsonArray2.get(5).getAsString()+" - Tel:"+ jsonArray2.get(4).getAsString() + "<br>"+"Dirección: "+ jsonArray2.get(7).getAsString() +" "+ jsonArray2.get(10).getAsString() +" - "+ jsonArray2.get(14).getAsString() + "<br><br>";
                        //    detalle.setCompoundDrawablesRelativeWithIntrinsicBounds(0,0,0,R.drawable.llamar2a);
                        //    detalle.setPadding(0,0,0,40);
                        }
                    }

                    String detallePaciente = (detalle.getText().toString());
                    detalle.setText(Html.fromHtml(str));

                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error){
            }
        }
        );
        queque.add(request);
    }

    public void verTratamientos(View view) {
        url = urlSrv +"srv/srvEmerFace.php?metodo=getTragamientosPaciente&pacId="+pacienteId;
        RequestQueue queque = Volley.newRequestQueue(this);
        StringRequest request = new StringRequest (url,new Response.Listener<String>(){
            @Override
            public void onResponse(String response){
                try {
                    JsonObject jsonObject = new JsonParser().parse(response).getAsJsonObject();
                    String str;
                    if (jsonObject.get("mensaje") != null){
                        str = "<br>"+jsonObject.get("mensaje").toString();
                    }
                    else {
                        JsonArray jsonArray = jsonObject.getAsJsonArray("resultados");
                        JsonArray jsonArray2 = null;
                        str =  "<br><br><b>Tratamientos registrados:</b><br>";
                        for (int i = 0; i < jsonArray.size(); i++){
                            jsonArray2 = jsonArray.get(i).getAsJsonArray();
                            str = str + jsonArray2.get(5).getAsString()+": "+ jsonArray2.get(2).getAsString()+" - "+ jsonArray2.get(3).getAsString() + "<br>";
                        }
                    }

                    TextView detalle = (TextView) findViewById(R.id.patolPaciente);
                    String detallePaciente = (detalle.getText().toString());
                    detalle.setText(Html.fromHtml(str));
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error){
            }
        }
        );
        queque.add(request);
    }

    public void verDatosPaciente(View view) {
        url = urlSrv +"srv/srvEmerFace.php?metodo=getPaciente&pacId="+pacienteId;
        RequestQueue queque = Volley.newRequestQueue(this);

        StringRequest request = new StringRequest (url,new Response.Listener<String>(){
            @Override
            public void onResponse(String response){
                try {
                    JsonObject jsonObject = new JsonParser().parse(response).getAsJsonObject();
                    JsonArray jsonArray = jsonObject.getAsJsonArray("resultados");

                    TextView detalle = (TextView) findViewById(R.id.patolPaciente);
                    String detallePaciente  = "<br>Nombre: <b>"+jsonArray.get(1).getAsString()+"</b><br><br> Fecha de nacimiento: <b>" + jsonArray.get(9).getAsString() + "</b> Grupo sangíneo: <b>" + jsonArray.get(8).getAsString() + "</b><br>Dirección: " + jsonArray.get(2).getAsString() + " " + jsonArray.get(3).getAsString()+ " " + jsonArray.get(4).getAsString()+ " " + jsonArray.get(5).getAsString()+ " - " + jsonArray.get(11).getAsString() + "<br> Documento: " + jsonArray.get(7).getAsString()+ " - Sexo: " + jsonArray.get(10).getAsString();
                    detalle.setText(Html.fromHtml(detallePaciente));
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error){
            }
        }
        );
        queque.add(request);
    }
}
