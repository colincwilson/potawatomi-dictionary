<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups": {"word:read"}},
 *  denormalizationContext={"groups": {"word:write"}}
 * )
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
     * @Groups({"word:read", "word:write"})
     */
    private $word;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"word:read", "word:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"word:read", "word:write"})
     */
    private $speechPart;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Example", mappedBy="word", orphanRemoval=true, cascade={"persist", "remove"})
     * @Groups({"word:read", "word:write"})
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

    public function getDefinition(): ?string
    {
        return $this->definition;
    }

    public function setDefinition(string $definition): self
    {
        $this->definition = $definition;

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
    public function getExamples(): Collection
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
