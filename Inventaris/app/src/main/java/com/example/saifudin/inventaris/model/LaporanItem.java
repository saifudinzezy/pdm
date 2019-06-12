package com.example.saifudin.inventaris.model;

import android.os.Parcel;
import android.os.Parcelable;

import com.google.gson.annotations.SerializedName;

public class LaporanItem implements Parcelable {

	@SerializedName("kode_daftar")
	private String kodeDaftar;

	@SerializedName("nama_asset")
	private String namaAsset;

	@SerializedName("jenis_asset")
	private String jenisAsset;

	@SerializedName("jml_asset")
	private String jmlAsset;

	@SerializedName("id")
	private String id;

	@SerializedName("tanggal")
	private String tanggal;

	@SerializedName("status")
	private String status;

	public void setKodeDaftar(String kodeDaftar){
		this.kodeDaftar = kodeDaftar;
	}

	public String getKodeDaftar(){
		return kodeDaftar;
	}

	public void setNamaAsset(String namaAsset){
		this.namaAsset = namaAsset;
	}

	public String getNamaAsset(){
		return namaAsset;
	}

	public void setJenisAsset(String jenisAsset){
		this.jenisAsset = jenisAsset;
	}

	public String getJenisAsset(){
		return jenisAsset;
	}

	public void setJmlAsset(String jmlAsset){
		this.jmlAsset = jmlAsset;
	}

	public String getJmlAsset(){
		return jmlAsset;
	}

	public void setId(String id){
		this.id = id;
	}

	public String getId(){
		return id;
	}

	public void setTanggal(String tanggal){
		this.tanggal = tanggal;
	}

	public String getTanggal(){
		return tanggal;
	}

	public void setStatus(String status){
		this.status = status;
	}

	public String getStatus(){
		return status;
	}

	@Override
 	public String toString(){
		return 
			"LaporanItem{" + 
			"kode_daftar = '" + kodeDaftar + '\'' + 
			",nama_asset = '" + namaAsset + '\'' + 
			",jenis_asset = '" + jenisAsset + '\'' + 
			",jml_asset = '" + jmlAsset + '\'' + 
			",id = '" + id + '\'' + 
			",tanggal = '" + tanggal + '\'' + 
			",status = '" + status + '\'' + 
			"}";
		}

	@Override
	public int describeContents() {
		return 0;
	}

	@Override
	public void writeToParcel(Parcel dest, int flags) {
		dest.writeString(this.kodeDaftar);
		dest.writeString(this.namaAsset);
		dest.writeString(this.jenisAsset);
		dest.writeString(this.jmlAsset);
		dest.writeString(this.id);
		dest.writeString(this.tanggal);
		dest.writeString(this.status);
	}

	public LaporanItem() {
	}

	protected LaporanItem(Parcel in) {
		this.kodeDaftar = in.readString();
		this.namaAsset = in.readString();
		this.jenisAsset = in.readString();
		this.jmlAsset = in.readString();
		this.id = in.readString();
		this.tanggal = in.readString();
		this.status = in.readString();
	}

	public static final Parcelable.Creator<LaporanItem> CREATOR = new Parcelable.Creator<LaporanItem>() {
		@Override
		public LaporanItem createFromParcel(Parcel source) {
			return new LaporanItem(source);
		}

		@Override
		public LaporanItem[] newArray(int size) {
			return new LaporanItem[size];
		}
	};
}