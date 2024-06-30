<?php

declare(strict_types=1);

namespace App\UI\DataImport;

use App\UI\Base\BasePresenter;
use Latte\Sandbox\Nodes\FunctionCallableNode;
use Nette;
use App\Parser\ParserLeafletOldFacade;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

final class DataImportPresenter extends Presenter
{
    #[Inject]
    public ParserLeafletOldFacade $parser;

    public int $sum_insert;
    public function __construct(
    ) {
        $this->sum_insert = -1;
    }

    public function handleGo(): void
    {
        if ($this->isAjax()) {
          $sum_insert = $this->parser->GoParser();
		    $this->payload->message = 'Success';
            $this->payload->sum_insert = $sum_insert;
            $this->sum_insert = $sum_insert;

	    }
    }

    public function beforeRender(): void
    {
        parent::beforeRender();
        $this->template->sum_insert = $this->sum_insert;
        $this->redrawControl('sum_insert');
    }

    public function renderShow(): void
    {
    }

}
