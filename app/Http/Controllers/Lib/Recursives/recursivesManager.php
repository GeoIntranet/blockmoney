<?php namespace App\Http\Controllers\Lib\Recursives;

use App\Account;
use App\Recursive;
use Carbon\Carbon;

class recursivesManager extends constantRecusives
{
    private $input;

    private $accountModel;

    private $user;
    private $name;
    private $account;
    private $periode;
    private $date;
    private $icone;
    private $type;
    public $readable;
    private $value;
    /**
     * @var Recursive
     */
    private $recusive;


    /**
     * recursivesManager constructor.
     * @param Account $account
     * @internal param $input
     */
    public function __construct(Account $accountModel, Recursive $recusive)
    {
        $this->accountModel = $accountModel;
        $this->recusive = $recusive;
    }


    /**
     * Prend en charge la phase d'initialisation
     */
    public function handle($input)
    {
        $this->input = $input;
        $this->hydrateField();
        return $this;
    }

    /**
     * Sauvegarde en BDD l'operation recusives
     */
    public function save()
    {
        $this->recusive->categorie_id = $this->icone ;
        $this->recusive->user_id = $this->user ;
        $this->recusive->account_id = $this->account ;
        $this->recusive->name =  $this->name ;
        $this->recusive->value = $this->value ;
        $this->recusive->active = 1 ;
        $this->recusive->date = $this->date ;
        $this->recusive->period = $this->periode ;
        $this->recusive->action = $this->type ;
        $this->recusive->readable_date = $this->readable ;

        $this->recusive->save() ;


        return $this->recusive;
    }

    /**
     * Hydrate les données
     */
    private function hydrateField()
    {
        $this->icone = $this->setIcone();
        $this->user = auth()->id();
        $this->account = $this->input['account'];
        $this->value = $this->input['valeur'];
        $this->name = $this->input['nom'];
        $this->type = $this->input['type'];

        $this->handlePeriode();
        $this->handleDate();

        $this->readable();
    }

    /**
     * Set l'intervall Jour / Semaine / Mois / Année
     * @return $this
     */
    private function handlePeriode()
    {
        isset ($this->constantPeriode[$this->input['periode']])
            ?
            $this->periode = $this->constantPeriode[$this->input['periode']]
            :
            $this->periode = 3;

        return $this;
    }

    /**
     * Set la date
     * @return $this
     */
    private function handleDate()
    {
        $periodString = $this->map[$this->periode];

        $interval = $this->{$periodString};

        isset($interval[$this->input['precise']])
            ?
            $this->date = $interval[$this->input['precise']]
            :
            $this->date = 3
        ;

    }

    /**
     * @return mixed
     */
    private function setIcone()
    {
        $cat = $this->input['icone'] ;
        return 1;
    }

    private function readable()
    {
        $this->readable = '';

        switch ($this->periode){

            case 3 :
                $this->input['precise'] <> 'Dernier Jour'
                    ?
                    $this->readable = 'Tous les '.$this->input['precise'].' du mois.'
                    :
                    $this->readable = 'Le dernier jour du mois'
                ;
                break;

            case 1 :
                $this->readable = 'Tous les jours a '.$this->input['precise'];
                break;

            case 2 :
                $this->readable = 'Tous les '.$this->input['precise'].' a 8h.';
                break;

            case 4 :
                $this->readable = 'Tous les 1er '.$this->input['precise'];
                break;
        }
    }


}