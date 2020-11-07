<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Undocumented function
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 1000; $i++) {
            $post = new Post();
            $post->setTitle("Article N°" . $i);
            $post->setContent("Contenu N°" . $i);
            $post->setUser($this->getReference(sprintf("user-%d",($i % 10) + 1)));
            $post->setImage("http://picsum.photos/400/300");
            $manager->persist($post);

            for ($j=1; $j <= rand(5,25) ; $j++) { 
                $comment = new Comment();
                $comment->setAuthor("Auteur N°" .rand(1,15));
                $comment->setContent("Commentaire N°" .$j);
                $comment->setPost($post);
                $manager->persist($comment);

            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
