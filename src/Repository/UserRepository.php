<?php

namespace App\Repository;

use App\Data\SearchUser;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, User::class);
        $this->paginator = $paginator;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @param SearchUser $search
     * @return PaginationInterface
     */
    public function findSearch(SearchUser $search): PaginationInterface
    {

        $query = $this
            ->createQueryBuilder('user')
            ->where("user.isEduc = false")
            ->andWhere("user.firstName IS NOT NULL AND user.lastName IS NOT NULL")
            ->orderBy('user.id', 'DESC')
        ;

        if (isset($search->q)) {
            $query = $query
                ->andWhere("CONCAT(user.firstName,' ',user.lastName) LIKE :q OR CONCAT(user.lastName,' ',user.firstName) LIKE :q")
                ->setParameter('q', "%{$search->q}%");
        }

        if (isset($search->promo)) {
            $query = $query
                ->andWhere('user.promo = :promo')
                ->setParameter('promo', $search->promo);
        }

        if (isset($search->bac)) {
            $query = $query
                ->andWhere('user.bac = :bac')
                ->setParameter('bac', $search->bac);
        }


        if (isset($search->fieldStudy)) {
            $query = $query
                ->andWhere('user.fieldStudy = :fieldStudy')
                ->setParameter('fieldStudy', $search->fieldStudy);
        }

        if (isset($search->fieldActivity)) {
            $query = $query
                ->andWhere('user.fieldActivity = :fieldActivity')
                ->setParameter('fieldActivity', $search->fieldActivity);
        }



        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            3
        );
    }


    /**
     * @return array
     */
    public function findAllCompany(): array
    {

        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT user.company
            FROM App\Entity\User user
            WHERE user.company IS NOT NULL ')

        ;

        // returns an array of Product objects
        return $query->getResult();
    }



}
