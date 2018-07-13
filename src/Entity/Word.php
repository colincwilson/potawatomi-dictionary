<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\WordRepository")
 */
class Word
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $word;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $speechPart;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Example", mappedBy="word", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $examples;

    public function __construct()
    {
        $this->examples = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSpeechPart(): ?string
    {
        return $this->speechPart;
    }

    public function setSpeechPart(string $speechPart): self
    {
        $this->speechPart = $speechPart;

        return $this;
    }

    /**
     * @return Collection|Example[]
     */
    public function getExamples(): iterable
    {
        return $this->examples;
    }

    public function addExample(Example $example): self
    {
        if (!$this->examples->contains($example)) {
            $this->examples[] = $example;
            $example->setWord($this);
        }

        return $this;
    }

    public function removeExample(Example $example): self
    {
        if ($this->examples->contains($example)) {
            $this->examples->removeElement($example);
            // set the owning side to null (unless already changed)
            if ($example->getWord() === $this) {
                $example->setWord(null);
            }
        }

        return $this;
    }
}
