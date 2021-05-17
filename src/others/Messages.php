<?php


namespace App\others;


class Messages
{
//succesMessage

public $listSuccesMessages = array(
    "insertGame" => "le jeux à bien été enregistrer"
)

;

    /**
     * Messages constructor.
     * @param string[] $listSuccesMessages
     */
    public function __construct(array $listSuccesMessages)
    {
        $this->listSuccesMessages = $listSuccesMessages;
    }


    /**
     * @return string[]
     */
    public function getListSuccesMessages(): array
    {
        return $this->listSuccesMessages;
    }

    /**
     * @param string[] $listSuccesMessages
     */
    public function setListSuccesMessages(array $listSuccesMessages): void
    {
        $this->listSuccesMessages = $listSuccesMessages;
    }

public function getSuccesMessage($nameMessage){
    $list = $this->getListSuccesMessages();
/*    $hey = array_search("insertGame",$list);*/

    dd( $list['insertGame']);
    return  $list['insertGame'];
}

}