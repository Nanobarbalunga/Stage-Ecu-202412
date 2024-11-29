<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\Comment;

class inserire_dato extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mik:app:inserire_dato {nome} {interessi?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

       $commento = new Comment();
       $commento->text="Michele è un grande";
       $commento->article_id=0;
       $result = $commento->save();

       $articolo = new Article();
       $articolo->text="Michele è un grande";
       $articolo->article_id=0;
       $result = $commento->save();

       if($result){
        $this->info("Andata bene");
       }
       else{
        $this->info("Andata bene");
       }

       
    }

    public function test1(){
        $nome = $this->argument('nome');
        $interessi = $this->argument('interessi') ?? null; 

        DB::table('tabellina')->insert([
            'nome' => $nome,
            'interessi' => $interessi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this -> info('Dati inseriri con successo');
    }
}
