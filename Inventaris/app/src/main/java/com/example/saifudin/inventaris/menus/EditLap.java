package com.example.saifudin.inventaris.menus;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.TextInputEditText;
import android.support.v4.widget.NestedScrollView;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.example.saifudin.inventaris.R;
import com.example.saifudin.inventaris.model.LaporanItem;
import com.example.saifudin.inventaris.model.ResponseInput;
import com.example.saifudin.inventaris.network.ApiService;
import com.example.saifudin.inventaris.network.RetroClient;

import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static com.example.saifudin.inventaris.constan.Koneksi.SUCCESS;
import static com.example.saifudin.inventaris.helper.CekEditText.editText;

public class EditLap extends AppCompatActivity {

    @BindView(R.id.ic_close)
    ImageView icClose;
    @BindView(R.id.title)
    LinearLayout title;
    @BindView(R.id.wrapper)
    LinearLayout wrapper;
    @BindView(R.id.input_nama)
    TextInputEditText inputNama;
    @BindView(R.id.rb_bergerak)
    RadioButton rbBergerak;
    @BindView(R.id.rb_tdk_bergrak)
    RadioButton rbTdkBergrak;
    @BindView(R.id.rg)
    RadioGroup rg;
    @BindView(R.id.input_jml)
    TextInputEditText inputJml;
    @BindView(R.id.ns)
    NestedScrollView ns;
    @BindView(R.id.btn_simpan)
    Button btnSimpan;
    @BindView(R.id.txt_judul)
    TextView txtJudul;
    LaporanItem data;
    int jns;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_insert_lap);
        ButterKnife.bind(this);

        txtJudul.setText("Edit Laporan");
        data = getIntent().getParcelableExtra("data");
        if (data != null) {
            inputJml.setText(data.getJmlAsset());
            inputNama.setText(data.getNamaAsset());
            if (data.getJenisAsset().equalsIgnoreCase("1")) {
                rbBergerak.setChecked(true);
            } else {
                rbTdkBergrak.setChecked(true);
            }
        }

        rg.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                switch (checkedId) {
                    case R.id.rb_bergerak:
                        jns = 1;
                        break;
                    case R.id.rb_tdk_bergrak:
                        jns = 0;
                        break;
                    default:
                        break;
                }
            }
        });
    }

    @OnClick({R.id.ic_close, R.id.btn_simpan})
    public void onViewClicked(View view) {
        switch (view.getId()) {
            case R.id.ic_close:
                onBackPressed();
                break;
            case R.id.btn_simpan:
                if (editText(inputNama, "Nama Kosong")) return;
                if (editText(inputJml, "Jumlah Kosong")) return;
                if (editText(inputJml) && editText(inputNama)) {
                    update(data.getKodeDaftar(), inputNama.getText().toString(), jns,
                            inputJml.getText().toString(), data.getStatus(), data.getTanggal(), data.getId());
                }
                break;
        }
    }

    private void update(String kode, String nama, int jenis, String jumlah, String status, String tanggal, String id) {
        final ProgressDialog dialog = new ProgressDialog(this);
        dialog.setMessage("Tunggu Sebentar...");

        ApiService service = RetroClient.getApiService();
        Call<ResponseInput> call = service.updateLap(id, kode, nama, jenis, jumlah, status, tanggal);
        dialog.show();
        call.enqueue(new Callback<ResponseInput>() {
            @Override
            public void onResponse(Call<ResponseInput> call, Response<ResponseInput> response) {
                try {
                    if (response.body().getCode() == SUCCESS) {
                        dialog.dismiss();
                        Toast.makeText(EditLap.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                        startActivity(new Intent(EditLap.this, Laporan.class));
                        finish();
                    } else {
                        Toast.makeText(EditLap.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                        dialog.dismiss();
                    }
                } catch (Exception e) {

                }
            }

            @Override
            public void onFailure(Call<ResponseInput> call, Throwable t) {
                Toast.makeText(EditLap.this, "" + t.getMessage(), Toast.LENGTH_SHORT).show();
                dialog.dismiss();
            }
        });
    }
}