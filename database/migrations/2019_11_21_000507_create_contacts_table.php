<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 200)->nullable(true)->index();
            $table->string('email', 200)->nullable(true)->index();
            $table->string('name', 200)->index();
            $table->string('civil_code', 50)->nullable(true)->index();
            $table->string('pin', 50)->nullable(true)->index();
            $table->enum('gender', ['PRIA', 'WANITA'])->nullable(true)->index();
            $table->enum('blood_type', ['A', 'AB', 'B', 'O'])->nullable(true)->index();
            $table->enum('agency_type', ['INSTANSI', 'ASURANSI'])->nullable(true)->index();
            $table->enum('job', ['PNS', 'SWASTA', 'WIRASWASTA', 'TNI/POLRI', 'PETANI', 'NELAYAN', 'PTT', 'IBU RTGA'])->nullable(true)->index();
            $table->enum('marriage_status', ['PRIA', 'WANITA'])->nullable(true)->index();
            $table->enum('religion', ['ISLAM', 'KRISTEN', 'KATOLIK', 'HINDU', 'BUDHA', 'KONGHUCU', 'LAINNYA'])->nullable(true)->index();
            $table->string('address', 500)->nullable(true)->index();
            $table->string('postal_code', 15)->nullable(true)->index();
            $table->string('phone', 30)->nullable(true)->index();
            $table->string('fax', 30)->nullable(true)->index();
            $table->unsignedInteger('account_id')->nullable(true)->index();
            $table->date('start_date')->nullable(true)->index();
            $table->date('birth_date')->nullable(true)->index();
            $table->integer('age')->nullable(false)->default(0)->index();
            $table->unsignedInteger('province_id')->nullable(true)->index();
            $table->unsignedInteger('city_id')->nullable(true)->index();
            $table->unsignedInteger('district_id')->nullable(true)->index();
            $table->unsignedInteger('village_id')->nullable(true)->index();
            $table->enum('patient_type', ['ANAK', 'NYONYA', 'NONA', 'TUAN'])->nullable(true)->index();
            $table->integer('is_active')->nullable(false)->default(1)->index();
            $table->integer('is_contact')->nullable(false)->default(0)->index();
            $table->integer('is_agency')->nullable(false)->default(0)->index();
            $table->integer('is_patient')->nullable(false)->default(0)->index();
            $table->integer('is_supplier')->nullable(false)->default(0)->index();
            $table->integer('is_nurse')->nullable(false)->default(0)->index();
            $table->integer('is_employee')->nullable(false)->default(0)->index();
            $table->integer('is_doctor')->nullable(false)->default(0)->index();
            $table->integer('is_family')->nullable(false)->default(0)->index();
            $table->integer('is_nurse_helper')->nullable(false)->default(0)->index();
            $table->unsignedInteger('specialization_id')->nullable(true)->index();
            $table->unsignedInteger('family_id')->nullable(true)->index();
            $table->unsignedInteger('polyclinic_id')->nullable(true)->index();
            $table->unsignedInteger('contact_id')->nullable(true)->index();
            $table->unsignedInteger('group_user_id')->nullable(true)->index();
            $table->unsignedInteger('supplier_id')->nullable(true)->index();
            $table->integer('supplier_disc_percent')->nullable(false)->default(0);
            $table->integer('pharmacy_disc_percent')->nullable(false)->default(0);
            $table->double('lab_sender_fee_value')->nullable(false)->default(0);
            $table->double('lab_refer_sender_fee_value')->nullable(false)->default(0);
            $table->double('xray_sender_fee_value')->nullable(false)->default(0);
            $table->double('xray_read_fee_value')->nullable(false)->default(0);
            $table->double('usg_sender_fee_value')->nullable(false)->default(0);
            $table->double('usg_read_fee_value')->nullable(false)->default(0);
            $table->double('ecg_sender_fee_value')->nullable(false)->default(0);
            $table->double('ecg_read_fee_value')->nullable(false)->default(0);
            $table->double('medical_action_fee_value')->nullable(false)->default(0);
            $table->double('consultation_fee_value')->nullable(false)->default(0);
            $table->timestamps();

            $table->foreign('group_user_id')
              ->references('id')->on('permissions')
              ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
