<?php

declare(strict_types=1);

/*
 * This file is part of SolidInvoice project.
 *
 * (c) 2013-2017 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\DashboardBundle\Widgets;

use SolidInvoice\QuoteBundle\Entity\Quote;
use SolidInvoice\QuoteBundle\Repository\QuoteRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class RecentQuotesWidget implements WidgetInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $manager;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->manager = $registry->getManager();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        /** @var QuoteRepository $quoteRepository */
        $quoteRepository = $this->manager->getRepository(Quote::class);

        $quotes = $quoteRepository->getRecentQuotes();

        return ['quotes' => $quotes];
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return '@SolidInvoiceDashboard/Widget/recent_quotes.html.twig';
    }
}
