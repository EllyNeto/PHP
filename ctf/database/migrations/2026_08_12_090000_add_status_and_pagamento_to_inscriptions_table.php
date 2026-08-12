<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndPagamentoToInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            if (!Schema::hasColumn('inscriptions', 'status')) {
                $table->string('status')->default('pendente')->after('bi');
            }
            if (!Schema::hasColumn('inscriptions', 'pagamento_info')) {
                $table->string('pagamento_info')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            if (Schema::hasColumn('inscriptions', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('inscriptions', 'pagamento_info')) {
                $table->dropColumn('pagamento_info');
            }
        });
    }
}
