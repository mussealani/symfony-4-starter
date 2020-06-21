<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class BlogPostAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('title')
            ->add('draft')
            ->add('category', null, [], EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('title')
            ->add('category.name')
            ->add('draft')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('Content', ['class' => 'col-md-9'])
                ->add('title')
                ->add('body')
                ->add('draft')
            ->end()
            ->with('Meta tag', ['class' => 'col-md-3'])
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                ])
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('title')
            ->add('body')
            ->add('draft')
            ;
    }

    public function toString($object)
    {
        return $object instanceof BlogPost
            ? $object->getTitle()
            : 'Blog Post';
    }
}
