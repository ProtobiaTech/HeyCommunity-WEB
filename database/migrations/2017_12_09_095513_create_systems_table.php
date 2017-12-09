<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\Model;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $code = <<<EOT
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-100926968-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config", "UA-100926968-2");
</script>
EOT;

        Schema::create('systems', function (Blueprint $table) use ($code) {
            $table->increments('id');
            $table->string('site_title')->default('HeyCommunity');
            $table->string('site_subheading')->default('A New HeyCommunity Site');
            $table->string('site_description')->nullable()->default('This Is A New HeyCommunity Site');
            $table->string('site_keywords')->nullable()->default('HeyCommunity, Social Site, Open Software');
            $table->text('site_analytic_code')->nullable()->default($code);

            $table->softDeletes();
            $table->timestamps();
        });


        Model::unguard();

        \App\System::create([]);

        Model::reguard();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('systems');
    }
}
