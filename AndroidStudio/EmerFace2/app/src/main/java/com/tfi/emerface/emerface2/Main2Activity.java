package com.tfi.emerface.emerface2;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.Arrays;

import static com.tfi.emerface.emerface2.R.drawable.paciente2;

public class Main2Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

        Intent intent = getIntent();
        String pacienteId = intent.getStringExtra(MainActivity.PACIENTE);
        TextView textView = (TextView) findViewById(R.id.nombrePaciente);
        textView.setText(pacienteId);

        Bitmap mBitmap2 = BitmapFactory.decodeResource(getResources(),paciente2);
        ImageView imageView  = (ImageView) findViewById(R.id.imageView2);
        imageView.setImageBitmap(mBitmap2);

    }

    public void nuevaBusqueda(View view) {
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);
    }




}
