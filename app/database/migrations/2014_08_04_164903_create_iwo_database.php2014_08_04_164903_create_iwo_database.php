<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIwoDatabase extends Migration {

        /**
         * Run the migrations.
         *
         * @return void
         */
         public function up()
         {
            
	    /**
	     * Table: account_directors
	     */
	    Schema::create('account_directors', function($table) {
                $table->increments('id')->unsigned();
                $table->string('name', 255);
                $table->string('email', 255);
            });


	    /**
	     * Table: assigned_roles
	     */
	    Schema::create('assigned_roles', function($table) {
                $table->increments('id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->integer('role_id')->unsigned();
                $table->index('assigned_roles_user_id_foreign');
                $table->index('assigned_roles_role_id_foreign');
            });


	    /**
	     * Table: copy_contacts
	     */
	    Schema::create('copy_contacts', function($table) {
                $table->increments('id')->unsigned();
                $table->string('email', 255);
                $table->string('name', 255);
                $table->string('formtype_id', 255);
                $table->timestamp('created_at')->default("0000-00-00 00:00:00");
                $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
                $table->index('emailrecipients_formtype_id_foreign');
            });


	    /**
	     * Table: formtypes
	     */
	    Schema::create('formtypes', function($table) {
                $table->increments('id')->unsigned();
                $table->string('key', 255);
                $table->string('title', 255);
                $table->string('label', 255);
                $table->timestamp('created_at')->default("0000-00-00 00:00:00");
                $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
                $table->index('formtypes_key_unique');
            });


	    /**
	     * Table: iwo_refs
	     */
	    Schema::create('iwo_refs', function($table) {
                $table->increments('id')->unsigned();
                $table->string('iwo_id', 255);
                $table->string('iwo_ref', 255);
                $table->timestamp('created_at')->default("0000-00-00 00:00:00");
                $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
                $table->index('iwo_refs_iwo_id_foreign');
            });


	    /**
	     * Table: logs
	     */
	    Schema::create('logs', function($table) {
                $table->increments('id')->unsigned();
                $table->string('iwo_id', 255);
                $table->string('user_id', 255);
                $table->mediumText('log');
                $table->string('type', 255)->default("standard");
                $table->timestamp('created_at')->default("0000-00-00 00:00:00");
                $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
            });


	    /**
	     * Table: notes
	     */
	    Schema::create('notes', function($table) {
                $table->increments('id')->unsigned();
                $table->longText('note');
                $table->string('iwo_id', 255);
                $table->string('user_id', 255);
                $table->timestamp('created_at')->default("0000-00-00 00:00:00");
                $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
                $table->index('notes_iwo_id_foreign');
                $table->index('notes_user_id_foreign');
            });


	    /**
	     * Table: permission_role
	     */
	    Schema::create('permission_role', function($table) {
                $table->increments('id')->unsigned();
                $table->integer('permission_id')->unsigned();
                $table->integer('role_id')->unsigned();
                $table->index('permission_role_permission_id_foreign');
                $table->index('permission_role_role_id_foreign');
            });


	    /**
	     * Table: permissions
	     */
	    Schema::create('permissions', function($table) {
                $table->increments('id')->unsigned();
                $table->string('name', 255);
                $table->string('display_name', 255);
                $table->timestamp('created_at')->default("0000-00-00 00:00:00");
                $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
                $table->index('permissions_name_unique');
            });


	    /**
	     * Table: roles
	     */
	    Schema::create('roles', function($table) {
                $table->increments('id')->unsigned();
                $table->string('name', 255);
                $table->timestamp('created_at')->default("0000-00-00 00:00:00");
                $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
                $table->index('roles_name_unique');
            });


	    /**
	     * Table: spad_reps
	     */
	    Schema::create('spad_reps', function($table) {
                $table->increments('id')->unsigned();
                $table->string('spad', 255);
                $table->string('rep', 255);
            });


	    /**
	     * Table: unit_reps
	     */
	    Schema::create('unit_reps', function($table) {
                $table->increments('id')->unsigned();
                $table->string('fipra_unit', 255);
                $table->string('rep', 255);
            });


	    /**
	     * Table: users
	     */
	    Schema::create('users', function($table) {
                $table->increments('id')->unsigned();
                $table->string('email', 255);
                $table->string('name', 255);
                $table->string('iwo_id', 255);
                $table->timestamp('created_at')->default("0000-00-00 00:00:00");
                $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
                $table->string('remember_token', 100)->nullable();
                $table->index('users_iwo_id_foreign');
            });


	    /**
	     * Table: workorders
	     */
	    Schema::create('workorders', function($table) {
                $table->increments('id')->unsigned();
                $table->longText('workorder');
                $table->string('title', 255);
                $table->boolean('confirmed');
                $table->boolean('cancelled');
                $table->integer('formtype_id');
                $table->timestamp('created_at')->default("0000-00-00 00:00:00");
                $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
                $table->index('workorders_formtype_id_foreign');
            });


         }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
         public function down()
         {
            
	            Schema::drop('account_directors');
	            Schema::drop('assigned_roles');
	            Schema::drop('copy_contacts');
	            Schema::drop('formtypes');
	            Schema::drop('iwo_refs');
	            Schema::drop('logs');
	            Schema::drop('notes');
	            Schema::drop('permission_role');
	            Schema::drop('permissions');
	            Schema::drop('roles');
	            Schema::drop('spad_reps');
	            Schema::drop('unit_reps');
	            Schema::drop('users');
	            Schema::drop('workorders');
         }

}