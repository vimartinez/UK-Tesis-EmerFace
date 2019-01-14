package com.tfi.emerface.emerface;

import android.graphics.Bitmap;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ImageView;

public class MainActivity extends AppCompatActivity {

    private FaceServerClient faceServerClient = new FaceServerClient ("f72f0fc759c14ad182c7581832e235a3", "https://westcentralus.api.cognitive.microsoft.com/face/v1.0");
    private final String personGroupId = "fut";

    ImageView imageView;
    Bitmap myBitmap;
    Face[] facesDetected;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }
}
