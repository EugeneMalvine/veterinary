<?php

namespace App\DataFixtures;

use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Serializer\SerializerInterface;

class GroupFixtures extends Fixture
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function load(ObjectManager $manager)
    {
        $group = new Group();
        $this->serializer->deserialize(
            json_encode([
                'permissions' => ['e7012425-63b6-4b12-a5bb-6da6cdf2bfc7', 'cfe9b56a-7265-4cc6-953a-a9f59dc112a7', '6f87c711-6822-46cd-abce-a4ba979820c5'],
                'name' => 'admin',
                'alias' => 'Администратор',
            ]),
            Group::class,
            'json',
            ['object_to_populate' => $group]
        );

        $manager->persist($group);

        $group = new Group();
        $this->serializer->deserialize(
            json_encode([
                'permissions' => ['a76a008d-a913-433a-be7f-844893ab7393'],
                'name' => 'client',
                'alias' => 'Клиент',
            ]),
            Group::class,
            'json',
            ['object_to_populate' => $group]
        );
        $manager->persist($group);

        $manager->flush();
    }
}