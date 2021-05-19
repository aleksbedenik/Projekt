package com.example.userinformation;

import java.sql.Time;
import java.util.Date;

public class UserActivities {
    Date datum;
    int ocena_aktivnosti,koraki,prabljenje_kalorije,povp_srcni_utrip,povp_hitrost,razadlja;
    Time cas;
    String username;
    String ime;

    @Override
    public String toString() {
        return "UserActivities{" +
                "datum=" + datum +
                ", ocena_aktivnosti=" + ocena_aktivnosti +
                ", koraki=" + koraki +
                ", prabljenje_kalorije=" + prabljenje_kalorije +
                ", povp_srcni_utrip=" + povp_srcni_utrip +
                ", povp_hitrost=" + povp_hitrost +
                ", razadlja=" + razadlja +
                ", cas=" + cas +
                ", username='" + username + '\'' +
                ", ime='" + ime + '\'' +
                '}';
    }

    public void setDatum(Date datum) {
        this.datum = datum;
    }

    public void setOcena_aktivnosti(int ocena_aktivnosti) {
        this.ocena_aktivnosti = ocena_aktivnosti;
    }

    public void setKoraki(int koraki) {
        this.koraki = koraki;
    }

    public void setPrabljenje_kalorije(int prabljenje_kalorije) {
        this.prabljenje_kalorije = prabljenje_kalorije;
    }

    public void setPovp_srcni_utrip(int povp_srcni_utrip) {
        this.povp_srcni_utrip = povp_srcni_utrip;
    }

    public void setPovp_hitrost(int povp_hitrost) {
        this.povp_hitrost = povp_hitrost;
    }

    public void setRazadlja(int razadlja) {
        this.razadlja = razadlja;
    }

    public void setCas(Time cas) {
        this.cas = cas;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public void setIme(String ime) {
        this.ime = ime;
    }

    public Date getDatum() {
        return datum;
    }

    public int getOcena_aktivnosti() {
        return ocena_aktivnosti;
    }

    public int getKoraki() {
        return koraki;
    }

    public int getPrabljenje_kalorije() {
        return prabljenje_kalorije;
    }

    public int getPovp_srcni_utrip() {
        return povp_srcni_utrip;
    }

    public int getPovp_hitrost() {
        return povp_hitrost;
    }

    public int getRazadlja() {
        return razadlja;
    }

    public Time getCas() {
        return cas;
    }

    public String getUsername() {
        return username;
    }

    public String getIme() {
        return ime;
    }

    public UserActivities(Date datum, int ocena_aktivnosti, int koraki, int prabljenje_kalorije, int povp_srcni_utrip, int povp_hitrost, int razadlja, Time cas, String username, String ime) {
        this.datum = datum;
        this.ocena_aktivnosti = ocena_aktivnosti;
        this.koraki = koraki;
        this.prabljenje_kalorije = prabljenje_kalorije;
        this.povp_srcni_utrip = povp_srcni_utrip;
        this.povp_hitrost = povp_hitrost;
        this.razadlja = razadlja;
        this.cas = cas;
        this.username = username;
        this.ime = ime;
    }
}