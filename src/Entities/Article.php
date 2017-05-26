<?php
namespace Entities;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Table(name="articles")
 * @Entity
 **/
class Article
{
    /**
     * @Id
     * @var int
     * @Column(type="integer", name="id")
     * @GeneratedValue(strategy="AUTO")
     **/
    protected $id;
    /**
     * @Column(type="string", name="titre")
     **/
    protected $titre;

    /**
     * @var string
     * @Column(type="string", name="contenu")
     **/
    protected $contenu;

    /**
     * @var string
     * @Column(type="string", name="dateAjout")
     **/
    protected $dateAjout;


    /*
     * @OneToMany(targetEntity="Commentaire", mappedBy="article")
     */
    private $commentaires;

    /**
     * @return mixed
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @param mixed $commentaires
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @param mixed $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getExtrait(){
        $html = '<p>' . substr($this->contenu, 0, 200) . '[...]</p>';
        $html .= '<div class="smallBtnMore"><p><a href="/episode/'. $this->id .'">Voir la suite</a></p></div>';
        $html .= '<p class="sousBox"><i class="fa fa-commenting" aria-hidden="true"></i> 4 <span class="rightMarg"><i class="fa fa-eye" aria-hidden="true"></i>
        30</span></p>';
        return $html;
    }


}