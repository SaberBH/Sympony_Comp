<?php

namespace App\Test\Controller;

use App\Entity\Settings;
use App\Repository\SettingsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SettingsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SettingsRepository $repository;
    private string $path = '/settings/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Settings::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Setting index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'setting[aboutus]' => 'Testing',
            'setting[adresse]' => 'Testing',
            'setting[email]' => 'Testing',
            'setting[telephone]' => 'Testing',
        ]);

        self::assertResponseRedirects('/settings/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Settings();
        $fixture->setAboutus('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setEmail('My Title');
        $fixture->setTelephone('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Setting');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Settings();
        $fixture->setAboutus('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setEmail('My Title');
        $fixture->setTelephone('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'setting[aboutus]' => 'Something New',
            'setting[adresse]' => 'Something New',
            'setting[email]' => 'Something New',
            'setting[telephone]' => 'Something New',
        ]);

        self::assertResponseRedirects('/settings/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getAboutus());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getTelephone());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Settings();
        $fixture->setAboutus('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setEmail('My Title');
        $fixture->setTelephone('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/settings/');
    }
}
