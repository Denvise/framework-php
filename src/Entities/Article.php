<?php
namespace Entities;
/**
 * @Table(name="articles")
 * @Entity
 **/
class Article
{
    /**
     * @var int
     * @Id @Column(type="integer")
     * @GeneratedValue
     **/
    protected $id;
    /**
     * @Column(type="string")
     **/
    protected $titre;

    /**
     * @Column(type="string")
     **/
    protected $contenu;

    /**
     * @Column(type="string")
     **/
    protected $dateAjout;

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

    public function getExtrait(){
        $html = '<p>' . substr($this->contenu, 0, 200) . '[...]</p>';
        $html .= '<div class="smallBtnMore"><p><a href="/episode/'. $this->id .'">Voir la suite</a></p></div>';
        $html .= '<p class="sousBox"><i class="fa fa-commenting" aria-hidden="true"></i> 4 <span class="rightMarg"><i class="fa fa-eye" aria-hidden="true"></i>
        30</span></p>';
        return $html;
    }


}