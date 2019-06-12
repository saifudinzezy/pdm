package com.example.saifudin.inventaris.adapter;

import android.content.Context;
import android.graphics.Color;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.example.saifudin.inventaris.R;
import com.example.saifudin.inventaris.model.LaporanItem;

import java.util.List;

import butterknife.BindView;
import butterknife.ButterKnife;

import static com.example.saifudin.inventaris.helper.ConvertDate.ubahTanggal2;

public class LaporanAdapter extends RecyclerView.Adapter<LaporanAdapter.ViewHolder> {
    private Context context;
    private List<LaporanItem> list;
    private LaporanAdapterListener listener;

    public LaporanAdapter(Context context, List<LaporanItem> list) {
        this.context = context;
        this.list = list;
    }

    public LaporanAdapter(Context context, List<LaporanItem> list, LaporanAdapterListener listener) {
        this.context = context;
        this.list = list;
        this.listener = listener;
    }

    public List<LaporanItem> getList() {
        return list;
    }

    public void setList(List<LaporanItem> list) {
        this.list = list;
        notifyDataSetChanged();
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_lap, parent, false);
        return new ViewHolder(layout);
    }

    @Override
    public void onBindViewHolder(final ViewHolder viewHolder, final int position) {
        viewHolder.txtNama.setText(list.get(position).getNamaAsset());
        viewHolder.txtJml.setText(list.get(position).getJmlAsset());
        viewHolder.txtTanggal.setText(ubahTanggal2(list.get(position).getTanggal()));
        viewHolder.txtJenis.setText(list.get(position).getJenisAsset());
        viewHolder.txtStatus.setText(list.get(position).getStatus());
        viewHolder.menus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                listener.onSelect(position, getList().get(position), v);
            }
        });

        if (viewHolder.txtJenis.getText().toString().equalsIgnoreCase("1")) {
            viewHolder.txtJenis.setText("Bergerak");
        } else {
            //red
            viewHolder.txtJenis.setText("Tidak Bergerak");
        }

        if (viewHolder.txtStatus.getText().toString().equalsIgnoreCase("2")) {
            //green
            viewHolder.background.setBackgroundColor(Color.parseColor("#00796B"));
            viewHolder.txtStatus.setText("Diterima");
        } else if (viewHolder.txtStatus.getText().toString().equalsIgnoreCase("0")) {
            //green
            viewHolder.background.setBackgroundColor(Color.parseColor("#ffb300"));
            viewHolder.txtStatus.setText("Belum diperiksa");
        } else {
            //red
            viewHolder.background.setBackgroundColor(Color.parseColor("#E43F3F"));
            viewHolder.txtStatus.setText("Ditolak");
        }
    }

    @Override
    public int getItemCount() {
        return getList().size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {
        @BindView(R.id.txt_tanggal)
        TextView txtTanggal;
        @BindView(R.id.txt_nama)
        TextView txtNama;
        @BindView(R.id.txt_jenis)
        TextView txtJenis;
        @BindView(R.id.txt_jml)
        TextView txtJml;
        @BindView(R.id.txt_status)
        TextView txtStatus;
        @BindView(R.id.linear)
        LinearLayout background;
        @BindView(R.id.cv)
        CardView cv;
        @BindView(R.id.menus)
        ImageView menus;

        public ViewHolder(View itemView) {
            super(itemView);
            ButterKnife.bind(this, itemView);
        }
    }

    public interface LaporanAdapterListener {
        void onSelect(int index, LaporanItem data, View view);
    }
}