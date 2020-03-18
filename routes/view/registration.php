<?php

Route::name('registration.')->prefix('registration')
->group(function(){

    Route::get('/', function (){
        return view('registration/registration/index');
    })->name('index');
    Route::get('/create', function (){
        return view('registration/registration/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('registration/registration/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('registration/registration/show')->withId($id);
    })->name('show');
});

Route::name('medical_record.')->prefix('medical_record')
->group(function(){

    Route::get('/step/1/edit/{id}', function ($id){
        if(Specialization::allow_access('anamnesa') != 1) {
            $alternative = ['anamnesa_obgyn', 'umum', 'children', 'surgical', 'kepala', 'breast', 'rectum', 'medical_checkup', 'tindakan', 'diagnostik', 'obat', 'bhp', 'sewa_alkes', 'sewa_ruangan', 'radiologi', 'laboratorium', 'patologi', 'fnab', 'histopatologi', 'papsmear', 'sitologi', 'jadwal_kontrol', 'resume_medis', 'assesment'];
            $alternative_route = ['2', 'physique.general', 'physique.children', 'physique.surgical', 'physique.head', 'physique.breast', 'physique.rectum', 'medical_checkup', 'therapy.treatment', 'therapy.diagnostic', 'therapy.drug', 'utilization.bhp', 'utilization.sewa_alkes', 'utilization.sewa_ruangan', 'radiology', 'laboratory', 'pathology', 'permintaan.fnab', 'permintaan.histopatologi', 'permintaan.papsmear', 'permintaan.sitologi', 'schedule', 'resume_medis', 'assesment'];
            foreach($alternative as $key => $role) {
                if(Specialization::allow_access($role) == 1) {
                    return redirect()->route('medical_record.edit.' . $alternative_route[$key], ['id' => $id]);
                }                
            }
        } else {
            return view('registration/medical_record/create')->withId($id);
        }
    })->name('edit');
    Route::get('/step/2/edit/{id}', function ($id){
        return view('registration/medical_record/create-2')->withId($id);
    })->name('edit.2');

    Route::get('/physique/general/{id}', function ($id){
        if(Specialization::allow_access('umum') != 1) {
            $alternative = ['children', 'surgical', 'kepala', 'breast', 'rectum'];
            $alternative_route = ['children', 'surgical', 'head', 'breast', 'rectum'];
            foreach($alternative as $key => $role) {
                if(Specialization::allow_access($role) == 1) {
                    return redirect()->route('medical_record.edit.physique.' . $alternative_route[$key], ['id' => $id]);
                }                
            }
        } else {
            return view('registration/medical_record/create-physique-general')->withId($id);
        }

    })->name('edit.physique.general');

    Route::get('/physique/children/{id}', function ($id){
        return view('registration/medical_record/create-physique-children')->withId($id);
    })->name('edit.physique.children');


    Route::get('/physique/surgical/{id}', function ($id){
        return view('registration/medical_record/create-physique-surgical')->withId($id);
    })->name('edit.physique.surgical');


    Route::get('/physique/head/{id}', function ($id){
        return view('registration/medical_record/create-physique-head')->withId($id);
    })->name('edit.physique.head');

    Route::get('/physique/breast/{id}', function ($id){
        return view('registration/medical_record/create-physique-breast')->withId($id);
    })->name('edit.physique.breast');
    Route::get('/physique/rectum/{id}', function ($id){
        return view('registration/medical_record/create-physique-rectum')->withId($id);
    })->name('edit.physique.rectum');

    Route::get('/medical_checkup/{id}', function ($id){
        return view('registration/medical_record/create-medical_checkup')->withId($id);
    })->name('edit.medical_checkup');

    Route::get('/therapy/treatment/{id}', function ($id){
        if(Specialization::allow_access('tindakan') != 1) {
            $alternative = ['diagnostik', 'obat'];
            $alternative_route = ['diagnostic', 'drug'];
            foreach($alternative as $key => $role) {
                if(Specialization::allow_access($role) == 1) {
                    return redirect()->route('medical_record.edit.therapy.' . $alternative_route[$key], ['id' => $id]);
                }                
            }
        } else {
            return view('registration/medical_record/create-therapy-treatment')->withId($id);
        }
    })->name('edit.therapy.treatment');
    Route::get('/therapy/diagnostic/{id}', function ($id){
        return view('registration/medical_record/create-therapy-diagnostic')->withId($id);
    })->name('edit.therapy.diagnostic');
    Route::get('/therapy/drug/{id}', function ($id){
        return view('registration/medical_record/create-therapy-drug')->withId($id);
    })->name('edit.therapy.drug');
    Route::get('/therapy/treatment_group/{id}', function ($id){
        return view('registration/medical_record/create-therapy-treatment_group')->withId($id);
    })->name('edit.therapy.treatment_group');

    Route::get('/utilization/bhp/{id}', function ($id){
        if(Specialization::allow_access('bhp') != 1) {
            $alternative = ['sewa_alkes', 'sewa_ruangan'];
            $alternative_route = ['sewa_alkes', 'sewa_ruangan'];
            foreach($alternative as $key => $role) {
                if(Specialization::allow_access($role) == 1) {
                    return redirect()->route('medical_record.edit.utilization.' . $alternative_route[$key], ['id' => $id]);
                }                
            }
        } else {
            return view('registration/medical_record/create-utilization-bhp')->withId($id);
        }
    })->name('edit.utilization.bhp');
    Route::get('/utilization/sewa_alkes/{id}', function ($id){
        return view('registration/medical_record/create-utilization-sewa_alkes')->withId($id);
    })->name('edit.utilization.sewa_alkes');
    Route::get('/utilization/sewa_ruangan/{id}', function ($id){
        return view('registration/medical_record/create-utilization-sewa_ruangan')->withId($id);
    })->name('edit.utilization.sewa_ruangan');

    Route::get('/permintaan/fnab/{id}', function ($id){
        if(Specialization::allow_access('umum') != 1) {
            $alternative = ['histologi', 'papsmear', 'sitologi'];
            $alternative_route = ['histologi', 'papsmear', 'sitologi'];
            foreach($alternative as $key => $role) {
                if(Specialization::allow_access($role) == 1) {
                    return redirect()->route('medical_record.edit.permintaan.' . $alternative_route[$key], ['id' => $id]);
                }                
            }
        } else {

            return view('registration/medical_record/create-permintaan-fnab')->withId($id);
        }
    })->name('edit.permintaan.fnab');
    Route::get('/permintaan/histopatologi/{id}', function ($id){
        return view('registration/medical_record/create-permintaan-histopatologi')->withId($id);
    })->name('edit.permintaan.histopatologi');
    Route::get('/permintaan/papsmear/{id}', function ($id){
        return view('registration/medical_record/create-permintaan-papsmear')->withId($id);
    })->name('edit.permintaan.papsmear');
    Route::get('/permintaan/sitologi/{id}', function ($id){
        return view('registration/medical_record/create-permintaan-sitologi')->withId($id);
    })->name('edit.permintaan.sitologi');

    Route::get('/resume/{id}', function ($id){
        return view('registration/medical_record/create-resume')->withId($id);
    })->name('edit.resume');

    Route::get('/assesment/{id}', function ($id){
        return view('registration/medical_record/create-assesment')->withId($id);
    })->name('edit.assesment');


    Route::get('/radiology/{id}', function ($id){
        return view('registration/medical_record/create-radiology')->withId($id);
    })->name('edit.radiology');
    Route::get('/laboratory/{id}', function ($id){
        return view('registration/medical_record/create-laboratory')->withId($id);
    })->name('edit.laboratory');
    Route::get('/pathology/{id}', function ($id){
        return view('registration/medical_record/create-pathology')->withId($id);
    })->name('edit.pathology');
    Route::get('/schedule/{id}', function ($id){
        return view('registration/medical_record/create-schedule')->withId($id);
    })->name('edit.schedule');


    Route::get('/step/1/show/{id}', function ($id){
        return view('registration/medical_record/show')->withId($id);
    })->name('show');
    Route::get('/step/2/show/{id}', function ($id){
        return view('registration/medical_record/show-2')->withId($id);
    })->name('show.2');
    Route::get('/step/3/show/{id}', function ($id){
        return view('registration/medical_record/show-3')->withId($id);
    })->name('show.3');
    Route::get('/step/4/show/{id}', function ($id){
        return view('registration/medical_record/show-4')->withId($id);
    })->name('show.4');
    
    Route::get('/polyclinic/{id}/patient', function (){
        return view('registration/medical_record/index');
    })->name('index.polyclinic');
    Route::get('/radiology/{id}/patient', function (){
        return view('registration/medical_record/index');
    })->name('index.radiology');
    Route::get('/laboratory/{id}/patient', function (){
        return view('registration/medical_record/index');
    })->name('index.laboratory');
    Route::get('/chemoterapy/{id}/patient', function (){
        return view('registration/medical_record/index');
    })->name('index.chemoterapy');
    Route::get('/ruang_tindakan/{id}/patient', function (){
        return view('registration/medical_record/index');
    })->name('index.ruang_tindakan');
    Route::get('/medical_checkup/{id}/patient', function (){
        return view('registration/medical_record/index');
    })->name('index.medical_checkup');
});

Route::name('assesment.')->prefix('assesment')
->group(function(){

    Route::get('/step/1/edit/{id}', function ($id){
        return view('registration/assesment/create')->withId($id);
    })->name('edit');
    Route::get('/step/2/edit/{id}', function ($id){
        return view('registration/assesment/create-2')->withId($id);
    })->name('edit.2');
    Route::get('/step/3/edit/{id}', function ($id){
        return view('registration/assesment/create-3')->withId($id);
    })->name('edit.3');
    Route::get('/step/4/edit/{id}', function ($id){
        return view('registration/assesment/create-4')->withId($id);
    })->name('edit.4');
    Route::get('/step/history/{id}', function ($id){
        return view('registration/assesment/history')->withId($id);
    })->name('edit.history');


    Route::get('/step/1/show/{id}', function ($id){
        return view('registration/assesment/show')->withId($id);
    })->name('show');
    Route::get('/step/2/show/{id}', function ($id){
        return view('registration/assesment/show-2')->withId($id);
    })->name('show.2');
    Route::get('/step/3/show/{id}', function ($id){
        return view('registration/assesment/show-3')->withId($id);
    })->name('show.3');
    Route::get('/step/4/show/{id}', function ($id){
        return view('registration/assesment/show-4')->withId($id);
    })->name('show.4');
    
    Route::get('/{id}/patient', function (){
        return view('registration/assesment/index');
    })->name('index');
});
