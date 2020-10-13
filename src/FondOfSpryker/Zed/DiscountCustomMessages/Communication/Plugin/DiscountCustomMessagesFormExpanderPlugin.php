<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Spryker\Zed\Discount\Dependency\Plugin\Form\DiscountFormExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory getFactory()
 */
class DiscountCustomMessagesFormExpanderPlugin extends AbstractPlugin implements DiscountFormExpanderPluginInterface
{
    /**
     * Specification:
     *
     * This method will received builder object from discount form type, you can use it to add new form types.
     * Or return new which for builder object instance.
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormBuilderInterface
     * @api
     *
     */
    public function expandFormType(FormBuilderInterface $builder, array $options): FormBuilderInterface
    {
        // TODO: Implement expandFormType() method.
    }
}
