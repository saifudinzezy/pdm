package com.example.saifudin.inventaris.model;

import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponseLaporan{

	@SerializedName("code")
	private int code;

	@SerializedName("laporan")
	private List<LaporanItem> laporan;

	@SerializedName("status")
	private boolean status;

	public void setCode(int code){
		this.code = code;
	}

	public int getCode(){
		return code;
	}

	public void setLaporan(List<LaporanItem> laporan){
		this.laporan = laporan;
	}

	public List<LaporanItem> getLaporan(){
		return laporan;
	}

	public void setStatus(boolean status){
		this.status = status;
	}

	public boolean isStatus(){
		return status;
	}

	@Override
 	public String toString(){
		return 
			"ResponseLaporan{" + 
			"code = '" + code + '\'' + 
			",laporan = '" + laporan + '\'' + 
			",status = '" + status + '\'' + 
			"}";
		}
}