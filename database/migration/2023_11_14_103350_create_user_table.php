<?php

use App\Base\Schema;

class CreateUserTable
{
    public function up()
    {
        $schema = new Schema();
        $schema->create("customers", function ($table) {
            $table->increments("id");
            $table->string("name");
            $table->string("email");
            $table->string("password");
        });
    }

    public function down()
    {
        // Define down logic if needed
    }
}
