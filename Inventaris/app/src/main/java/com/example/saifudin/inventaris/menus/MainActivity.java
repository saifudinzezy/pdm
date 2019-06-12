package com.example.saifudin.inventaris.menus;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.CardView;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.saifudin.inventaris.R;
import com.example.saifudin.inventaris.login.Login;
import com.example.saifudin.inventaris.session.Session;

import java.util.Calendar;

import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;

import static com.example.saifudin.inventaris.constan.Logins.NAMA;
import static com.example.saifudin.inventaris.session.Session.SP_SUDAH_LOGIN2;

public class MainActivity extends AppCompatActivity {

    @BindView(R.id.txt_selamat)
    TextView txtSelamat;
    @BindView(R.id.txt_nama)
    TextView txtNama;
    @BindView(R.id.profile)
    CardView profile;
    @BindView(R.id.laporan)
    CardView laporan;
    @BindView(R.id.insert_lap)
    CardView insertLap;
    Session session;
    @BindView(R.id.exit)
    ImageView exit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        ButterKnife.bind(this);
        session = new Session(this);

        if (session.getSPSudahLogin2()) {
            Calendar c = Calendar.getInstance();
            int timeOfDay = c.get(Calendar.HOUR_OF_DAY);

            if (timeOfDay >= 0 && timeOfDay < 12) {
                txtSelamat.setText("Selamat datang dan Selamat Pagi");
            } else if (timeOfDay >= 12 && timeOfDay < 16) {
                txtSelamat.setText("Selamat datang dan Selamat Siang");
            } else if (timeOfDay >= 16 && timeOfDay < 21) {
                txtSelamat.setText("Selamat datang dan Selamat Sore");
            } else if (timeOfDay >= 21 && timeOfDay < 24) {
                txtSelamat.setText("Selamat datang dan Selamat Malam");
            }
            txtNama.setText(session.getSessionString(NAMA));
        }
    }

    @OnClick({R.id.profile, R.id.laporan, R.id.insert_lap, R.id.exit})
    public void onViewClicked(View view) {
        switch (view.getId()) {
            case R.id.profile:
                startActivity(new Intent(MainActivity.this, Profile.class));
                break;
            case R.id.laporan:
                startActivity(new Intent(MainActivity.this, Laporan.class));
                break;
            case R.id.insert_lap:
                startActivity(new Intent(MainActivity.this, InsertLap.class));
                break;
            case R.id.exit:
                AlertDialog.Builder aleBuilder = new AlertDialog.Builder(MainActivity.this);
                //settting judul dan pesan
                aleBuilder.setTitle("Keluar");
                aleBuilder
                        .setMessage("Apakah anda yakin ingin keluar?")
                        .setCancelable(false)
                        .setPositiveButton("Ya", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                session.saveSPBoolean(SP_SUDAH_LOGIN2, false);
                                startActivity(new Intent(MainActivity.this, Login.class)
                                        .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                                finish();
                            }
                        })
                        .setNegativeButton("Tidak", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                //cancel
                                dialog.cancel();
                            }
                        });
                AlertDialog alertDialog = aleBuilder.create();
                alertDialog.show();
                break;
        }
    }
}