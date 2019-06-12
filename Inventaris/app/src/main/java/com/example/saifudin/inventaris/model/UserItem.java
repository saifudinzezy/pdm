package com.example.saifudin.inventaris.model;

import com.google.gson.annotations.SerializedName;

public class UserItem{

	@SerializedName("password")
	private String password;

	@SerializedName("nama")
	private String nama;

	@SerializedName("kode_daftar")
	private String kodeDaftar;

	@SerializedName("id")
	private String id;

	@SerializedName("email")
	private String email;

	@SerializedName("alamat")
	private String alamat;

	public void setPassword(String password){
		this.password = password;
	}

	public String getPassword(){
		return password;
	}

	public void setNama(String nama){
		this.nama = nama;
	}

	public String getNama(){
		return nama;
	}

	public void setKodeDaftar(String kodeDaftar){
		this.kodeDaftar = kodeDaftar;
	}

	public String getKodeDaftar(){
		return kodeDaftar;
	}

	public void setId(String id){
		this.id = id;
	}

	public String getId(){
		return id;
	}

	public void setEmail(String email){
		this.email = email;
	}

	public String getEmail(){
		return email;
	}

	public void setAlamat(String alamat){
		this.alamat = alamat;
	}

	public String getAlamat(){
		return alamat;
	}

	@Override
 	public String toString(){
		return 
			"UserItem{" + 
			"password = '" + password + '\'' + 
			",nama = '" + nama + '\'' + 
			",kode_daftar = '" + kodeDaftar + '\'' + 
			",id = '" + id + '\'' + 
			",email = '" + email + '\'' + 
			",alamat = '" + alamat + '\'' + 
			"}";
		}
}