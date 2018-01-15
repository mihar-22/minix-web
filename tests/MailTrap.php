<?php

namespace Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\Assert;
use Psr\Http\Message\StreamInterface;

class MailTrap
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var mixed
     */
    private $mail;

    /**
     * @var int
     */
    private $inboxId = 315303;

    /**
     * @var string
     */
    private $apiToken = 'ca848eb4ec8b1be5f922f8d3c8a398c8';

    /**
     * @return Client
     */
    private function requestClient()
    {
        if (!$this->client) {
            $this->client = new Client([
                'base_uri' => 'https://mailtrap.io',
                'headers' => ['Api-Token' => $this->apiToken],
            ]);
        }

        return $this->client;
    }

    /**
     * @return string
     */
    private function getMessagesUrl()
    {
        return "/api/v1/inboxes/{$this->inboxId}/messages";
    }

    /**
     * @return string
     */
    private function getCleanInboxUrl()
    {
        return "/api/v1/inboxes/{$this->inboxId}/clean";
    }

    /**
     * Fetch the messages in the current inbox. See id above.
     *
     * @return StreamInterface
     */
    public function fetchInbox()
    {
        return $this->requestClient()
            ->get($this->getMessagesUrl())
            ->getBody();
    }

    /**
     * @return self
     */
    public function fetchMostRecentMail()
    {
        $this->mail = json_decode($this->fetchInbox())[0];

        return $this;
    }

    /**
     * Assert the email was sent to the correct address.
     *
     * @param string $to
     *
     * @return self
     */
    public function assertSentTo($to)
    {
        Assert::assertEquals($to, $this->mail->to_email);

        return $this;
    }

    /**
     * Assert the email contains the correct subject.
     *
     * @param string $subject
     *
     * @return self
     */
    public function assertSubjectIs($subject)
    {
        Assert::assertEquals($subject, $this->mail->subject);

        return $this;
    }

    /**
     * Assert the email contains the correct text.
     *
     * @param string $contains
     *
     * @return self
     */
    public function assertTextContains($contains)
    {
        Assert::assertContains($contains, $this->mail->text_body);

        return $this;
    }

    /**
     * Assert the body of the email contains the correct html.
     *
     * @param string $contains
     *
     * @return self
     */
    public function assertBodyContains($contains)
    {
        Assert::assertContains($contains, $this->mail->html_body);

        return $this;
    }

    public function cleanInbox()
    {
        $this->requestClient()->patch($this->getCleanInboxUrl(), ['future' => true]);
    }
}