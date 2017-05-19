<?php
namespace Entities;
/**
 * @Table(name="commentaires")
 * @Entity
 **/
class Commentaire
{
    /**
     * @Id
     * @var int
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     **/
    protected $id;
    /**
     * @var string
     * @Column(type="string")
     **/
    protected $pseudo;

    /**
     * @Column(type="string")
     **/
    protected $msg;

    /**
     * @var string
     * @Column(type="string")
     **/
    protected $dateAjout;


    /**
     * @var boolean
     * @Column(type="boolean")
     */
    protected $etat;

    /**
     * @var boolean
     * @Column(type="boolean")
     */
    protected $prioritaire;

    /**
     * @return bool
     */
    public function isPrioritaire()
    {
        return $this->prioritaire;
    }

    /**
     * @param bool $prioritaire
     */
    public function setPrioritaire($prioritaire)
    {
        $this->prioritaire = $prioritaire;
    }



    /**
     * @return bool
     */
    public function isEtat()
    {
        return $this->etat;
    }

    /**
     * @param bool $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


    /**
     * @Column(type="integer")
     */
    protected $id_article;

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->id_article;
    }

    /**
     * @param mixed $id_article
     */
    public function setIdArticle($id_article = null)
    {
        $this->id_article = $id_article;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }


    /**
     * @param mixed $dateAjout
     */
    public function setDateAjout(\DateTime $dateAjout = null)
    {
        $this->dateAjout = $dateAjout;
    }

    public function getComment(){
        $html = '<p class="dateZonCom">'.$this->dateAjout.'</p>';
        $html .= '<p class="commentaire">'.$this->msg.'</p>';
        $html .= '<h5 class="pseudo"> <img src="images/spera.png"/> '.$this->pseudo.'</h5>';
        return $html;
    }


}