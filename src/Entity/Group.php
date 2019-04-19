<?php

namespace App\Entity;

use App\Entity\Permission;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 * @ORM\Table(name="user_group")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $alias;

    /**
     * @ORM\ManyToMany(targetEntity="Permission")
     * @ORM\JoinTable(
     *      name="group_permissons",
     *      joinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="permission_id", referencedColumnName="id")}
     *      )
     */
    private $permissions;

    public function __construct()
    {
        $this->permissions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function setPermissions(array $permissions): self
    {
        $this->permissions = new ArrayCollection($permissions);

        return $this;
    }

    public function addPermission(Permission $permission): self
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
        }

        return $this;
    }

    public function hasPermission(string $permissionName): bool
    {
        return $this->getPermissions()->exists(function ($key, Permission $element) use ($permissionName) {

            return $element->getName() === $permissionName;
        });
    }

    public function hasCreateGroupAccess(): bool
    {
        return $this->hasPermission(Permission::CREATE_USER_ACTION);
    }

    public function hasEditGroupAccess(): bool
    {
        return $this->hasPermission(Permission::EDIT_USER_ACTION);
    }

    public function hasViewGroupAccess(): bool
    {
        return $this->hasPermission(Permission::VIEW_ADMIN);
    }

    public function hasViewPetsGroupAccess(): bool
    {
        return $this->hasPermission(Permission::VIEW_PETS);
    }
}
